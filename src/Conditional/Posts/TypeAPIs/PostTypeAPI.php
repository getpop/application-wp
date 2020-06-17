<?php

declare(strict_types=1);

namespace PoP\ApplicationWP\Conditional\Posts\TypeAPIs;

use PoP\Hooks\Facades\HooksAPIFacade;
use PoP\Translation\Facades\TranslationAPIFacade;

/**
 * Methods to interact with the Type, to be implemented by the underlying CMS
 */
class CustomPostTypeAPI extends \PoP\CustomPostsWP\TypeAPIs\CustomPostTypeAPI
{
    public function getExcerpt($customPostObjectOrID): ?string
    {
        list(
            $customPost,
            $customPostID,
        ) = $this->getCustomPostObjectAndID($customPostObjectOrID);
        $readmore = sprintf(
            TranslationAPIFacade::getInstance()->__('... <a href="%s">Read more</a>', 'pop-application'),
            $this->getPermalink($customPostObjectOrID)
        );
        $value = empty($customPost->post_excerpt) ?
            \limitString(
                \strip_tags(
                    \strip_shortcodes($customPost->post_content)
                ),
                \getExcerptLength(),
                $readmore
            ) :
            $customPost->post_excerpt;
        return HooksAPIFacade::getInstance()->applyFilters('get_the_excerpt', $value, $customPostID);
    }
}
