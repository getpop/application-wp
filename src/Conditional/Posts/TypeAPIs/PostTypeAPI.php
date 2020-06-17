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
    public function getExcerpt($postObjectOrID): ?string
    {
        list(
            $post,
            $postID,
        ) = $this->getCustomPostObjectAndID($postObjectOrID);
        $readmore = sprintf(
            TranslationAPIFacade::getInstance()->__('... <a href="%s">Read more</a>', 'pop-application'),
            $this->getPermalink($postObjectOrID)
        );
        $value = empty($post->post_excerpt) ? \limitString(\strip_tags(\strip_shortcodes($post->post_content)), $this->getExcerptLength(), $readmore) : $post->post_excerpt;
        return HooksAPIFacade::getInstance()->applyFilters('get_the_excerpt', $value, $postID);
    }
}
