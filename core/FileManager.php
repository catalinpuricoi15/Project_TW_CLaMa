<?php

namespace core;

class FileManager
{
    public static function uploadFile($formField, $fileDestinationPath)
    {
        if (isset($_FILES[$formField]) && $_FILES[$formField]['name'] != "") {
            $fileName = $_FILES[$formField]['name'];
            $tmpName = $_FILES[$formField]['tmp_name'];
            $extensions = ['doc', 'pdf', 'doc', 'png', 'jpg', 'jpeg'];
            $fileExtension = explode('.', $fileName)[1];
            if (in_array($fileExtension, $extensions)) {
                $fileDestinationPath = $fileDestinationPath.".".$fileExtension;
                $absDestinationPath = Application::$ROOT_DIR . "/public" . $fileDestinationPath;
                move_uploaded_file($tmpName, $absDestinationPath);
                return $fileDestinationPath;
            }
        }
        return null;
    }
}