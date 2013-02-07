function addHtmlToFCKEditorForImage(path, title){
    CKEDITOR.instances.form_text.insertHtml('<img src="' + path + '" title="' + title + '" class="left" style="float: left; width: 200px;">');    
    $('#cboxClose').click(); 
}