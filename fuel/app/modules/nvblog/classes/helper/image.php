<?php

namespace NVBlog;

class Helper_Image 
{

    /**
     * 
     * @param Array $file
     *      Array of info about an uploaded file
     * @param Array $model
     *      An array that must contain: title, user_id, text
     * @return Model_Image
     */
    public static function upload_file($file, $model)
    {
        \Config::load('nvblog::custom');

        $upload_path = \Config::get('upload_path');
        $upload_dimensions = \Config::get('upload_dimensions');

        // Generate thumb
        foreach ($upload_dimensions as $dim)
        {
            $dim_array = explode("x", $dim);

            \Image::load($upload_path . 'tmp' . DS . $file['saved_as'])
                ->crop_resize($dim_array[0], $dim_array[1])
                ->save($upload_path . $dim . DS . $file['saved_as']);
        }

        // Generate max width image
        \Image::load($upload_path . 'tmp' . DS . $file['saved_as'])
            ->save($upload_path . 'original' . DS . $file['saved_as']);

        // Delete original image
        Helper_Image::delete_files($file['saved_as'], array('tmp'));

        // Create a new image
        $image =  Model_Image::forge(array(
            'user_id' => $model['user_id'],
            'filename' => $file['saved_as'],
            'size' => $file['size'],
            'title' => $model['title'],
            'slug' => \Inflector::friendly_title($model['title'], '-', true),
            'text' => $model['text'],
            ));

        return $image;
    }

    /**
     * 
     * @param String $filename
     *      Name of the file to delete
     * @param Array $dimensions
     *      Array of dimensions to delete
     * @return Bool $error
     *      True if there was an error, false otherwise
     */
    public static function delete_files($filename, $dimensions = array())
    {
        \Config::load('nvblog::custom');

        $error = false;
        $upload_path = \Config::get('upload_path');

        // Get image dimensions to delete 
        if(count($dimensions) == 0)
        {
            $dimensions = \Config::get('upload_dimensions');
        }

        // Delete all physics images
        foreach ($dimensions as $dim) 
        {
            $path = $upload_path . $dim . DS . $filename;
            if(!unlink($path))
            {
                $error = true;
                break;
            }
        }

        return $error;
    }
}

/* End of file */
