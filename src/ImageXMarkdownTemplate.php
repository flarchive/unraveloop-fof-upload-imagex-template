<?php

namespace Unraveloop\ImageXTemplate;

use FoF\Upload\Contracts\Template;
use FoF\Upload\File;
use Flarum\Settings\SettingsRepositoryInterface;

class ImageXMarkdownTemplate implements Template
{
    protected $settings;

    // 依赖注入，获取后台设置
    public function __construct(SettingsRepositoryInterface $settings)
    {
        $this->settings = $settings;
    }

    public function tag(): string
    {
        return 'imagex-markdown-center';
    }

    public function name(): string
    {
        return 'ImageX Markdown Center';
    }

    public function description(): string
    {
        return 'Adds ImageX processing suffix and wraps image in [center] tag.';
    }

    public function preview(File $file): string
    {
        // 1. 读取后台填写的 ImageX 后缀
        $imagexSuffix = $this->settings->get('unraveloop-fof-upload-imagex-template.suffix', '');
        
        // 2. 优化：获取真实文件名，并去掉扩展名作为 alt 文本
        // 例如 "my-vacation-photo.jpg" 变成 "my-vacation-photo"
        $altText = pathinfo($file->base_name, PATHINFO_FILENAME);
        // 防御性编程：如果文件名没拿到，用默认词兜底
        if (empty($altText)) {
            $altText = 'image';
        }

        // 3. 拼接终极 Markdown 格式
        // 格式：[center]![真实的alt文本](带有后缀的URL "真实的悬停title")[/center]
        return '[center]![' . $altText . '](' . $file->url . $imagexSuffix . ' "' . $altText . '")[/center]';
    }
}