# 文档管理工具，使用markdown解析。

## 结构
```
	|--  [Library]   扩展库目录
			|-- [GoogleAuthenticator] 谷歌验证扩展
			|-- [Parsedown]           markdown解析类
	|-- [Public]     公共目录(css/js/img)
			|-- [css]
				|-- [markdown]          markdown css
				|-- [base.css]          基础css
				|-- [docs-sidenav.css]  文档侧边栏快速导航css
				|-- [loaders.css]		loading css
				|-- [login.css]         登陆css
				|-- [main.css]          首页主样式表
				|-- [reset.css]         样式重置css
			|-- [js]
				|-- [base.js] 基础js，所有的window.onload事件都在这个文件中使用，不允许在调用此js的页面中再重复使用此事件，否则会造成base.js中所有的函数失效.
				|-- 其他js
			|-- [img]
			|-- [plugin]
				|-- [font-awesome-4.4.0] 字体图标
 				|-- [highlight]          代码高亮
				|-- [validate]           表单验证插件
	|-- [config.php] 配置文件
	|-- [function.php] 函数文件
	|-- [header.php] 头部导入文件
	|-- [index.php] 入口文件
	|-- [login.php]
```

## 用户权限
如果你的文档需要在线上部署，且需要限制查看的人。则需开启此权限，不需要则关闭此权限。

### 开启登陆验证
在 `config.php` 中修改 `__AUTH__` 为 `TRUE`,并在 `$UserInfo` 数组中定义你要部署的用户名和KEY,因为本项目使用的是 `GoogleAuthenticator` 动态生成的登陆密码，所以需要用户在客户端下载软件，并扫描或者手动输入生成的key ( 具体使用方法请百度 ).

### 文档存放目录
参照 `config.php` 中 `__API__` 配置的目录，存放你的API markdown文档，推荐放在用户访问不到的目录。

### 文档规则
第一级必须为目录，第二级必须为 `*.md` 的文件，具体如下：
```
	|-- API 主目录
		|-- 目录1
			|-- api1.md
		|-- 目录2
			|-- api1.md
		|-- 目录3
			|-- api1.md
		|-- 目录4
			|-- api1.md
```
如果格式不对则无法显示文档。

### 写在最后
因为没有使用数据库，所以该文档的性能有限，等我后期更新吧。