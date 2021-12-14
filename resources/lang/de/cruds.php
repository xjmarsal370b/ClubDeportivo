<?php

return [
    'userManagement' => [
        'title'          => 'Benutzerverwaltung',
        'title_singular' => 'Benutzerverwaltung',
    ],
    'permission' => [
        'title'          => 'Zugriffsrechte',
        'title_singular' => 'Berechtigung',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Rollen',
        'title_singular' => 'Rolle',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Benutzer',
        'title_singular' => 'Benutzer',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'email'                     => 'Email',
            'email_helper'              => ' ',
            'email_verified_at'         => 'Email verified at',
            'email_verified_at_helper'  => ' ',
            'password'                  => 'Password',
            'password_helper'           => ' ',
            'roles'                     => 'Roles',
            'roles_helper'              => ' ',
            'remember_token'            => 'Remember Token',
            'remember_token_helper'     => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'approved'                  => 'Approved',
            'approved_helper'           => ' ',
            'verified'                  => 'Verified',
            'verified_helper'           => ' ',
            'verified_at'               => 'Verified at',
            'verified_at_helper'        => ' ',
            'verification_token'        => 'Verification token',
            'verification_token_helper' => ' ',
        ],
    ],
    'event' => [
        'title'          => 'Evento',
        'title_singular' => 'Evento',
        'fields'         => [
            'id'                    => 'ID',
            'id_helper'             => ' ',
            'event_name'            => 'Evento',
            'event_name_helper'     => 'Introduzca el nombre del evento deportivo',
            'date_event'            => 'Fecha y Hora',
            'date_event_helper'     => 'Introduzca la fecha y hora a la que el evento tendrá lugar',
            'desc_event'            => 'Descripción',
            'desc_event_helper'     => 'Breve descripción del evento',
            'created_at'            => 'Created at',
            'created_at_helper'     => ' ',
            'updated_at'            => 'Updated at',
            'updated_at_helper'     => ' ',
            'deleted_at'            => 'Deleted at',
            'deleted_at_helper'     => ' ',
            'transportation'        => 'Transporte',
            'transportation_helper' => 'Indique el transporte usado para el evento',
            'organizer'             => 'Organizador del evento',
            'organizer_helper'      => ' ',
            'member'                => 'Miembro',
            'member_helper'         => ' ',
            'event_img'             => 'Imagen Descriptiva',
            'event_img_helper'      => 'Puede añadir una imagen al evento con un tamaño máximo de 5MB y una resolución de máxima de 2048x2048.',
        ],
    ],
    'post' => [
        'title'          => 'Noticias',
        'title_singular' => 'Noticia',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'post_title'         => 'Título',
            'post_title_helper'  => 'Introduzca un título para su artículo',
            'post_header'        => 'Cabecera',
            'post_header_helper' => 'Breve resumen o introducción del artículo',
            'post_status'        => 'Estado del artículo',
            'post_status_helper' => ' ',
            'user'               => 'Usuario',
            'user_helper'        => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'category'           => 'Categoría',
            'category_helper'    => ' ',
            'post_img'           => 'Imagen',
            'post_img_helper'    => 'Puede añadir una imagen al artículo con un tamaño máximo de 5MB y una resolución de máxima de 2048x2048.',
        ],
    ],
    'transportation' => [
        'title'          => 'Transportes',
        'title_singular' => 'Transporte',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'company_name'               => 'Nombre de la compañía',
            'company_name_helper'        => ' ',
            'transportation_type'        => 'Tipo de transporte',
            'transportation_type_helper' => ' ',
            'dep_place'                  => 'Lugar de salida',
            'dep_place_helper'           => 'Indique el lugar de salida',
            'dep_date'                   => 'Fecha y hora de salida',
            'dep_date_helper'            => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
        ],
    ],
    'eventOrganizer' => [
        'title'          => 'Organizadores de Evento',
        'title_singular' => 'Organizadores de Evento',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'description'        => 'Nombre',
            'description_helper' => 'Introduzca el nombre de la organización o empresa',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'postCategory' => [
        'title'          => 'Categoría',
        'title_singular' => 'Categoría',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'cat_name'          => 'Nombre',
            'cat_name_helper'   => 'Introduzca un nombre para una categoría de noticias',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'administracionDeEvento' => [
        'title'          => 'Administracion De Eventos',
        'title_singular' => 'Administracion De Evento',
    ],
    'administracionDeNoticium' => [
        'title'          => 'Administracion De Noticias',
        'title_singular' => 'Administracion De Noticia',
    ],
];
