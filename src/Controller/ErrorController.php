<?php

namespace App\Controller;

use iFrame\Controller\AbstractController;

class ErrorController extends AbstractController
{
    public function error_404(): string
    {
        return $this->renderView('errors/error_404.php', [
            'title' => 'Erreur 404',
            'content' => 'Aïe... Nous n\'avons pas trouvé la page.',
        ]);
    }
}
