import app from 'flarum/admin/app';

app.initializers.add('unraveloop-fof-upload-imagex-template', () => {
  app.extensionData
    .for('unraveloop-fof-upload-imagex-template')
    .registerSetting({
      setting: 'unraveloop-fof-upload-imagex-template.suffix', // 核心键值
      label: 'ImageX 模板后缀',
      type: 'text',
      help: '输入你在火山引擎配置的图片处理模板后缀，例如：~tplv-aabbccdd-114.webp',
      placeholder: '~tplv-aabbccdd-114.webp',
    });
});