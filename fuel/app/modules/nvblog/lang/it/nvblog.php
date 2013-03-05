<?php

return array(
    // Shared common values
    'shared' => array(
        'perform'   => 'Esegui',
        'send'      => 'Invia',
        'status'    => 'Stato',
        'used'      => 'Usato in una relazione',
        'view'      => 'Visualizza',
        'preview'   => 'Anteprima',
        'add'       => 'Aggiungi',
        'edit'      => 'Modifica',
        'delete'    => 'Elimina',
        'confirm'   => 'Sei sicuro?',
        'messages'  => array(
            'index' => array(
                'error' => 'Nessun contenuto selezionato',
                ),
            'add' => array(
                'success'   => 'Contenuto creato con successo',
                'error'     => 'Errore durante la creazione del contenuto',
                ),
            'edit' => array(
                'success'   => 'Contenuto modificato con successo',
                'error'     => 'Errore durante la modifica del contenuto',
                ),
            'delete' => array(
                'success'           => 'Contenuto eliminato con successo',
                'success_plural'    => 'Contenuti eliminati con successo',
                'error'             => 'Errore durante la creazione la cancellazione del contenuto',
                ),
            ),
        'publish_status' => array(
            'draft'     => 'Bozza',
            'published' => 'Pubblicato',
            )
        ),

    // Exception values
    'exception' => array(
        'title_already_exists_exception' => 'Il titolo inserito è già presente',
        ),

    // Values for the public section
    'public' => array(
        ),

    // Values for the admin section
    'private' => array(
        'shared' => array(
            'action'        => 'Azioni',
            'title'         => 'Titolo',
            'tag'           => 'Tag',
            'preview'       => 'Occhiello',
            'text'          => 'Testo',
            'author'        => 'Autore',
            'contents'      => 'Contenuti',
            'categories'    => 'Categorie',
            'image'         => 'Immagine',
            'associations'  => 'Associazioni',
            'created_at'    => 'Data creazione',
            'updated_at'    => 'Ultima modifica',

            'options'       => 'Opzioni aggiuntive',
            'addimages'     => 'Aggiungi immagine dal blog'
            ),

        // Pages section
        'pages' => array(
            'shared' => array(
                'name_singular' => 'Pagina',
                'name_plural'   => 'Pagine',
                ),
            'index' => array('title' => 'Elenco pagine'),
            'view'  => array('title' => 'Dettaglio pagina'),
            'add'   => array('title' => 'Aggiungi pagina'),
            'edit'  => array('title' => 'Modifica pagina'),
            ),

        // Categories section
        'categories' => array(
            'shared' => array(
                'name_singular' => 'Categoria',
                'name_plural'   => 'Categorie',
                ),
            'index' => array('title' => 'Elenco categorie'),
            'view'  => array('title' => 'Dettaglio categoria'),
            'add'   => array('title' => 'Aggiungi categoria'),
            'edit'  => array('title' => 'Modifica categoria'),
            ),

        // Contents section
        'contents' => array(
            'shared' => array(
                'name_singular'     => 'Contenuto',
                'name_plural'       => 'Contenuti',
                'tag_instruction'   => 'I tag inseriti devono avere la struttura virgola+spazio: "tag1, tag numero 2, tag test 3, tag4"'
                ),
            'index' => array('title' => 'Elenco contenuti'),
            'view'  => array('title' => 'Dettaglio contenuto'),
            'add'   => array('title' => 'Aggiungi contenuto'),
            'edit'  => array('title' => 'Modifica contenuto'),
            ),

        // Images section
        'images'     => array(
            'shared'    => array(
                'name_singular'     => 'Immagine',
                'name_plural'       => 'Immagini',
                ),
            'index'     => array('title' => 'Lista immagini'),
            'view'      => array('title' => 'Dettaglio immagine'),
            'add'       => array('title' => 'Aggiungi immagine'),
            'edit'      => array('title' => 'Modifica immagine'),
            ),

        // Tags section
        'tags' => array(
            'shared' => array(
                'name_singular' => 'Tag',
                'name_plural'   => 'Tag',
                ),
            'index' => array('title' => 'Elenco tag'),
            'view'  => array('title' => 'Dettaglio tag'),
            'add'   => array('title' => 'Aggiungi tag'),
            'edit'  => array('title' => 'Modifica tag'),
            ),
        )
    );
