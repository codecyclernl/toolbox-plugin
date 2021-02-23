<?php namespace Codecycler\Toolbox\Classes\Behavior;

use October\Rain\Database\Model;
use Codecycler\Toolbox\Models\Tag;
use October\Rain\Extension\ExtensionBase;

class HasTags extends ExtensionBase
{
    public function __construct(Model $model)
    {
        $className = get_class($model);
        $modelName = ($exploded = explode('\\', $className))[count($exploded) - 1];

        Tag::extend(function (Tag $tagModel) use ($modelName, $className) {
            $tagModel->morphedByMany[strtolower($modelName) . 's'] = [
                $className,
                'name' => 'taggable',
                'table' => 'codecycler_toolbox_tags_taggables',
            ];
        });
    }
}