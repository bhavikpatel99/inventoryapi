<?php

if (!function_exists('upload_file')) {
    function upload_file($field_name, $upload_path = 'uploads/', $allowed_types = 'jpg|jpeg|png|gif', $max_size = 2048)
    {
        $file = \Config\Services::request()->getFile($field_name);

        if ($file === null) {
            return ['error' => 'No file selected or file upload error.'];
        }

        if (!$file->isValid() || $file->hasMoved()) {
            return ['error' => 'No file selected or file upload error.'];
        }

        $path = WRITEPATH . 'uploads/' . $upload_path;

        // Check if directory exists, if not, create it
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }

        // Validate file type and size
        $validation = \Config\Services::validation();
        $validation->setRules([
            $field_name => [
                'uploaded[' . $field_name . ']',
                'mime_in[' . $field_name . ', ' . $allowed_types . ']',
                'max_size[' . $field_name . ', ' . $max_size . ']',
            ]
        ]);

        if ($validation->run() === false) {
            return ['error' => $validation->getErrors()];
        }

        $new_name = $file->getRandomName(); // Generate a random name for the uploaded file
        $file->move($path, $new_name); // Move the file to the desired folder
        $validation = \Config\Services::validation();
        $validation->setRules([
            $field_name => [
                'uploaded[' . $field_name . ']',
                'mime_in[' . $field_name . ', ' . $allowed_types . ']',
                'max_size[' . $field_name . ', ' . $max_size . ']',
            ]
        ]);

        if ($validation->run() === false) {
            return ['error' => $validation->getErrors()];
        }

        return ['success' => 'File uploaded successfully!', 'file_name' => $new_name];
    }
}
