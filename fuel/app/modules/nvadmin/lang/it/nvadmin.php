<?php

return array(
    // Shared common values
    'shared'    => array(
        'perform'   => 'Esegui',
        'send'      => 'Invia',

        'view'      => 'Visualziza',
        'add'       => 'Aggiungi',
        'edit'      => 'Modifica',
        'delete'    => 'Elimina',
        'confirm'   => 'Sei sicuro?',

        'messages'  => array(
            'add'    => array(
                'success'   => 'Contenuto creato con successo',
                'error'     => 'Errore durante la creazione del contenuto',
                ),
            'edit'      => array(
                'success'   => 'Contenuto modificato con successo',
                'error'     => 'Errore durante la modifica del contenuto',
                ),
            'delete'    => array(
                'success'           => 'Contenuto eliminato con successo',
                'success_plural'    => 'Contenuti eliminati con successo',
                'error'             => 'Errore durante la creazione la cancellazione del contenuto',
                ),
            )
        ),

    // Exception values
    'exception' 	=> array(
        'username_already_exists_exception'     => 'L\'username scelto è già presente',
        'email_already_exists_exception'        => 'L\'email scelta è già presente',
        'old_password_invalid_exception'        => 'La vecchia password è errata',
        ),

    // Values for the public section
    'public' 	=> array(
        'login'         => 'Loggati per accedere alla sezione riservata',
        'login_success' => 'Sei stato loggato correttamente',
        'login_error'   => 'Dati errati, riprova',
        'logout'        => 'Ti sei disconnesso correttamente',
        ),

    // Values for the admin section
    'private' 	=> array(
        'shared'    => array(
            'action'        => 'Azioni',
            'title'         => 'Titolo',
            'tag'           => 'Tag',
            'preview'       => 'Preview',
            'text'          => 'Testo',
            'username'      => 'Username',
            'password'      => 'Password',
            'password_old'  => 'Vecchia password',
            'password_new'  => 'Nuova password',
            'email'         => 'Email',
            'created_at'    => 'Data creazione',
            'updated_at'    => 'Ultima modifica',
            'last_login'    => 'Ultimo login',
            'confirm'       => 'Conferma password',
            ),

        // Users section
        'users'     => array(
            'shared'    => array(
                'name_singular'     => 'Utente',
                'name_plural'       => 'Utenti',
                ),
            'index'     => array('title' => 'Elenco utenti'),
            'view'      => array('title' => 'Dettaglio utente'),
            'add'       => array('title' => 'Aggiungi utente'),
            'edit'      => array('title' => 'Modifica utente'),
            ),
        )
    );
