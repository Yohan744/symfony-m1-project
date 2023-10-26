<?php

namespace App\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('sidebar')]
class SidebarComponent
{
    public string $pseudo;
    public string $bgColor;

    public function mount(string $pPseudo, string $pBgColor): void
    {
        $this->pseudo = $pPseudo;
        $this->bgColor = $pBgColor;
    }
}
