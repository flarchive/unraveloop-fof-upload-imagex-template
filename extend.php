<?php

namespace Unraveloop\ImageXTemplate;

use Flarum\Extend;
use Flarum\Foundation\AbstractServiceProvider;
use FoF\Upload\Helpers\Util;

class ImageXServiceProvider extends AbstractServiceProvider
{
    public function boot()
    {
        // 确保 FoF Upload 已安装并加载
        if (class_exists(Util::class)) {
            $this->container->make(Util::class)->addRenderTemplate($this->container->make(ImageXMarkdownTemplate::class));
        }
    }
}

return [
    // 加载后台的前端 JS UI 文件
    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js'),

    // 注册服务端 Provider
    (new Extend\ServiceProvider())
        ->register(ImageXServiceProvider::class),
];