function docsSidenavFun() {
    var sidenav = $('#docs-sidenav');
    var h2_list     = $('.article h2');
    var h2_list_len = h2_list.length;

    if (h2_list_len <= 0) {
        return false;
    }

    /* 定义要给空锚点 */
    var anchor          = '';
    var anchor_name     = '';
    var sidenav_li_list = '';
    /* 把获取的h2列表输出到页面中 */
    h2_list.each(function(){
        anchor_name = $(this).text();
        /* 设置锚点名称 | 获取index值是防止h2内容相同导致id重复 */
        anchor      = 'docs-sidenav-anchor-' + anchor_name + $(this).index();

        /* 在h2上增加ID */
        $(this).attr({id: anchor});
        /* 导航列表增加数据 */
        sidenav_li_list += '<li><a href="#'+ anchor +'">'+ anchor_name +'</a></li>'
    });

    sidenav.find('ul').html(sidenav_li_list);
    /* 显示导航面板 */
    sidenav.show();
}