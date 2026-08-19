<?php

namespace App\Traits;

use Exception;

trait ThemeHelper
{
    public function getThemeRoutesArray(): array
    {
        $themeRoutes = [];

        try {
            if (defined('DOMAIN_POINTED_DIRECTORY') && DOMAIN_POINTED_DIRECTORY == 'public') {
                $filePath = base_path('public/themes/' . theme_root_path() . '/public/addon/theme_routes.php');
            } else {
                $filePath = base_path('resources/themes/' . theme_root_path() . '/public/addon/theme_routes.php');
            }

            if (theme_root_path() != 'default' && is_file($filePath)) {
                $result = include $filePath;
                // Si le fichier retourne bien un tableau, on l'utilise, sinon on garde []
                if (is_array($result)) {
                    $themeRoutes = $result;
                }
            }
        } catch (Exception $exception) {
            // En cas d'erreur, $themeRoutes reste []
        }

        return $themeRoutes;
    }
}