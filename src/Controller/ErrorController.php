<?php

namespace App\Controller;

use iFrame\Controller\AbstractController;
use iFrame\Entity\Response;

class ErrorController extends AbstractController
{
    public function error404(): Response
    {
        return $this->renderView('errors/error_404.php', [
            'title' => 'Erreur 404',
            'content' => 'Aïe... Nous n\'avons pas trouvé la page.',
        ]);
    }
}
