<?php

namespace NVBlog;

class Controller_NVBlog extends \Controller_Public 
{

    public function before() 
    {
        parent::before();

        // Get blog data
        $this->data['page_values']['categories'] = Model_Category::find()->order_by('title', 'asc')->get();
        $this->data['page_values']['pages'] = Model_Page::find()->where('published', 1)->order_by('title', 'asc')->get();

        // Set default template values
        $this->data['partials']['search'] = \Theme::instance()->set_partial('search', 'public/nvblog/_global/search');
        $this->data['partials']['categories'] = \Theme::instance()->set_partial('categories', 'public/nvblog/_global/categories');
        $this->data['partials']['pages'] = \Theme::instance()->set_partial('pages', 'public/nvblog/_global/pages');
    }

    public function action_index() 
    {
        // Create a pagination 
        $pagination = \Pagination::forge('pagination', array(
            'pagination_url' => \Uri::base(false) . 'blog/index/',
            'total_items' => Model_Content::find()->where('published', 1)->count(),
            'per_page' => 10,
            'uri_segment' => 3,
            'num_links' => 5,
            ));

        // Set values
        $contents = Model_Content::find()
            ->where('published', 1)
            ->order_by('id', 'desc')
            ->offset($pagination->offset)
            ->limit($pagination->per_page)
            ->get();

        // Set templates variables
        $this->data['template_values']['subtitle'] = 'Blog';
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['contents']= $contents;

        \Theme::instance()->set_partial('content', 'public/nvblog/index');
    }

    public function action_content($slug = '') 
    {
        $query = Model_Content::find()->where('slug', $slug);

        if(!\Auth::check()) 
        {
            $query = $query->where('published', 1);
        }

        $content = $query->get_one();

        // Security check
        if(empty($content)) 
        { 
            \Response::redirect('404'); 
        }

        // Set templates variables
        $this->data['template_values']['subtitle'] = $content->title;
        $this->data['page_values']['content'] = $content;

        \Theme::instance()->set_partial('content', 'public/nvblog/content');
    }

    public function action_page($slug = '') 
    {
        $query = Model_Page::find()->where('slug', $slug);

        if(!\Auth::check()) 
        {
            $query = $query->where('published', 1);
        }

        $page = $query->get_one();

        // Security check
        if(empty($page)) 
        { 
            \Response::redirect('404'); 
        }

        // Set templates variables
        $this->data['template_values']['subtitle'] = $page->title;
        $this->data['page_values']['page'] = $page;

        \Theme::instance()->set_partial('content', 'public/nvblog/page');
    }

    public function action_categories($title = '') 
    {        
        $category = Model_Category::query()
            ->where('title', $title)
            ->get_one();

        // Security check
        if(empty($category)) 
        { 
            \Response::redirect('404'); 
        }

        // Get published contents 
        $category->contents = $this->delete_draft_contents($category->contents);

        // Create a pagination
        $pagination = \Pagination::forge('pagination', array(
            'pagination_url' => \Uri::base(false) . 'blog/categories/' . $title . '/',
            'total_items' => empty($category->contents) ? 0 : count($category->contents),
            'per_page' => 5,
            'uri_segment' => 4,
            'num_links' => 5,
            ));

        $page = (\Uri::segment($pagination->uri_segment) != '') 
            ? \Uri::segment($pagination->uri_segment) - 1 
            : 0;

        // Set templates variables
        $this->data['template_values']['subtitle'] = $category->title;
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['contents'] = empty($category->contents) ? array() : array_slice($category->contents, $page * $pagination->per_page, $pagination->per_page);
        $this->data['page_values']['title'] = $category->title;

        \Theme::instance()->set_partial('content', 'public/nvblog/categories');
    }

    public function action_tags($title = '') 
    {
        $tag = Model_Tag::query()
            ->where('title', $title)
            ->get_one();

        if(empty($tag)) 
        { 
            \Response::redirect('404'); 
        }

        // Get published contents 
        $tag->contents = $this->delete_draft_contents($tag->contents);

        // Create a pagination
        $pagination = \Pagination::forge('pagination', array(
            'pagination_url' => \Uri::base(false) . 'blog/tags/' . $title . '/',
            'total_items' => empty($tag->contents) ? 0 : count($tag->contents),
            'per_page' => 5,
            'uri_segment' => 4,
            'num_links' => 5,
            ));

        $page = (\Uri::segment($pagination->uri_segment) != '') 
            ? \Uri::segment($pagination->uri_segment) - 1 
            : 0;

        // Set templates variables
        $this->data['template_values']['subtitle'] = $tag->title;
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['contents'] = empty($tag->contents) ? array() : array_slice($tag->contents, $page * $pagination->per_page, $pagination->per_page);
        $this->data['page_values']['title'] = $tag->title;

        \Theme::instance()->set_partial('content', 'public/nvblog/tags');
    }

    public function action_search($search = '') 
    {
        $search = (empty($search)) ? \Input::get('key', '') : $search;

        // Get search results
        $contents = Model_Content::query()
            ->where('title', 'LIKE', '%' . $search . '%')
            ->where('published', 1)
            ->order_by('id', 'desc')
            ->get();

        // Create a pagination
        $pagination = \Pagination::forge('pagination', array(
            'pagination_url' => \Uri::base(false) . 'blog/search/' . $search . '/',
            'total_items' => empty($contents) ? 0 : count($contents),
            'per_page' => 5,
            'uri_segment' => 4,
            'num_links' => 5,
            ));

        $page = (\Uri::segment($pagination->uri_segment) != '') 
            ? \Uri::segment($pagination->uri_segment) - 1 
            : 0;

        // Set templates variables
        $this->data['template_values']['subtitle'] = $search;
        $this->data['partials']['pagination'] = $pagination->render();
        $this->data['page_values']['contents'] = empty($contents) ? array() : array_slice($contents, $page * $pagination->per_page, $pagination->per_page);
        $this->data['page_values']['title'] = $search;

        \Theme::instance()->set_partial('content', 'public/nvblog/search');
    }

    public function delete_draft_contents($contents = array()) 
    {
        $published = array();

        foreach ($contents as $key => $value)
        {
            if($value->published == 1)
            {
                $published[$key] = $value;
            }
        }

        return $published;
    }

}

/* End of file */
