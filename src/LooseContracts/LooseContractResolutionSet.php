<?php
namespace PoP\ApplicationWP\LooseContracts;

use PoP\LooseContracts\Contracts\AbstractLooseContractResolutionSet;

class LooseContractResolutionSet extends AbstractLooseContractResolutionSet
{
    protected function resolveContracts()
    {
		$this->nameResolver->implementNames([
			'popcms:option:limit' => 'posts_per_page',
		]);
    }
}
