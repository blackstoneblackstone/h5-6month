var data = {
    xingbie: 0,
    nianling: 20,
    shengao: 160,
    xuexing: 0,
    xingzuo: "shizi",
    zeou: 1,
    avator: avator
};
var queue = new createjs.LoadQueue();
queue.on("complete", start, this);
queue.on("progress", progress, this);
queue.loadManifest([
    {id: "img1", src: "images/baiyang.png"},
    {id: "img3", src: "images/biao.png"},
    {id: "img4", src: "images/chunv.png"},
    {id: "img5", src: "images/da.png"},
    {id: "img6", src: "images/dc.png"},
    {id: "img7", src: "images/dui.png"},
    {id: "img8", src: "images/jinniu.png"},
    {id: "img9", src: "images/juxie.png"},
    {id: "img10", src: "images/logo.png"},
    {id: "img11", src: "images/mei.png"},
    {id: "img12", src: "images/mojie.png"},
    {id: "img14", src: "images/nl-title.png"},
    {id: "img15", src: "images/o1.png"},
    {id: "img16", src: "images/o2.png"},
    {id: "img17", src: "images/o3.png"},
    {id: "img18", src: "images/o4.png"},
    {id: "img19", src: "images/o5.png"},
    {id: "img20", src: "images/o6.png"},
    {id: "img22", src: "images/s-man.jpg"},
    {id: "img23", src: "images/s-title.png"},
    {id: "img24", src: "images/shengaochi.png"},
    {id: "img27", src: "images/sheshou.png"},
    {id: "img28", src: "images/shizi.png"},
    {id: "img30", src: "images/shuangyu.png"},
    {id: "img31", src: "images/shuangzi.png"},
    {id: "img32", src: "images/shuiping.png"},
    {id: "img33", src: "images/tianping.png"},
    {id: "img34", src: "images/tianxie.png"},
    {id: "img35", src: "images/title.jpg"},
    {id: "img36", src: "images/x-title.png"},
    {id: "img39", src: "images/xm.png"},
    {id: "img40", src: "images/z-title.png"},
    {id: "img41", src: "images/zhuang.png"},
    {id: "img42", src: "images/shengaon.png"},
]);
function progress(e) {
    $("#loadText").html(Math.round(e.progress * 100) + "%");
}
// start();
function start() {
    $("#loading").hide();
    impress().init();
    // $("body").css("height",window.screen.availHeight);
    $(".step").css("width", window.innerWidth * 2.5);
    $(".step").css("height", window.innerHeight * 2.5);
    //start 动画
    var srenHeight, dy, cha;
    $('body').on('touchmove touchstart', function (event) {
        event.preventDefault();
    });

    touch.on('#start1', 'touchstart', function (event) {
        $("#start1").css("background-color", "#ffffff");
    });


    var sei = setInterval(function () {
        $("#sa").hide();
        $("#daojishi").show();
        $("#daojishi").text($("#daojishi").text() - 1);
        if ($("#daojishi").text() == 0) {
            clearInterval(sei);
            impress().goto("xingbie");
        }
    }, 1000);

    touch.on('#start1', 'touchend', function (event) {
        $("#start1").css("background-color", "#cccccc");
        clearInterval(sei);
        impress().goto("xingbie");
    });

    //性别
    touch.on('#xb-n', 'touchend', function (ev) {
        $("#xb-n-g").show();
        $("#xb-v-g").hide();
        data.xingbie = 0;//0:男 1:女

        $("#nlXm").attr("src", "images/shengaon.png");
        $("#sgRen").attr("src", "images/shengaon.png");

        // $("#zo-r1").attr("src", "images/dc.png");
        // $("#zo-r2").attr("src", "images/xm.png");

        impress().next();
    });

    touch.on('#xb-v', 'touchend', function (ev) {
        $("#xb-v-g").show();
        $("#xb-n-g").hide();
        data.xingbie = 1;
        //
        $("#nlXm").attr("src", "images/xm.png");
        $("#sgRen").attr("src", "images/xm.png");
        //
        // $("#zo-r1").attr("src", "images/zhuang.png");
        // $("#zo-r2").attr("src", "images/shengaon.png");

        impress().next();
    });
    //年龄
    touch.on('#nl', 'drag', function (ev) {
        var nianling = $("#nl").text();
        if ((nianling - Math.round(ev.y / 100)) > 0 && (nianling - Math.round(ev.y / 100)) < 100) {
            $("#nl").text(nianling - Math.round(ev.y / 100));
        }
    });

    touch.on('#nlUp', 'touchend', function (ev) {
        if ($("#nl").text() > 0 && $("#nl").text() < 100) {
            $("#nl").text($("#nl").text() - 1 + 2);
        }
    });
    touch.on('#nlDown', 'touchend', function (ev) {
        if ($("#nl").text() > 1 && $("#nl").text() < 100) {
            $("#nl").text($("#nl").text() - 1);
        }
    });
    touch.on('#nl-next', 'touchend', function (ev) {
        data.nianling = Number($("#nl").text());
        if(data.xingbie==0){
            $("#zo-r1").attr("src", "images/dc.png");
            $("#zo-r2").attr("src", "images/xm.png");
        }else{
            $("#zo-r1").attr("src", "images/zhuang.png");
            $("#zo-r2").attr("src", "images/shengaon.png");
        }
        impress().next();
    });

    //身高
    var sgBiaoHeight;
    touch.on('#sg-biao', 'dragstart', function (ev) {
        sgBiaoHeight = $("#sg-biao").css("bottom");
        console.log("1>>>" + sgBiaoHeight);
        sgBiaoHeight = sgBiaoHeight.substring(0, sgBiaoHeight.length - 2);
        console.log("2>>>" + sgBiaoHeight);
    });
    touch.on('#sg-biao', 'drag', function (ev) {
        $("#sg-biao").css("bottom", (Number(sgBiaoHeight) - ev.y * 2));
        $("#sgRen").css("height", (Number(sgBiaoHeight) - ev.y * 2) + 50);
        $("#sg-text").text((Math.round(((Number(sgBiaoHeight) - ev.y * 2) - 316) / 13.8) + 150) + "CM");
        $("#sg-text").css("bottom", (Number(sgBiaoHeight) - ev.y * 2));
        data.shengao = Math.round(((Number(sgBiaoHeight) - ev.y * 2) - 316) / 13.8) + 150;
    });
    touch.on('#sg-next', 'touchend', function (ev) {
        impress().next();
    });

    //血型
    touch.on('#xx-a', 'touchend', function (ev) {
        $(".xx-d").hide();
        $("#xx-a-dui").show();
        $("#xx-a-dui").addClass("an-2");
        data.xuexing = 0;
        setTimeout(function () {
            impress().next();
        }, 700);
    });
    touch.on('#xx-b', 'touchend', function (ev) {
        $(".xx-d").hide();
        $("#xx-b-dui").show();
        $("#xx-b-dui").addClass("an-2");
        data.xuexing = 1;
        setTimeout(function () {
            impress().next();
        }, 700);
    });
    touch.on('#xx-ab', 'touchend', function (ev) {
        $(".xx-d").hide();
        $("#xx-ab-dui").show();
        $("#xx-ab-dui").addClass("an-2");
        data.xuexing = 2;
        setTimeout(function () {
            impress().next();
        }, 700);
    });
    touch.on('#xx-o', 'touchend', function (ev) {
        $(".xx-d").hide();
        $("#xx-o-dui").show();
        $("#xx-o-dui").addClass("an-2");
        data.xuexing = 3;
        setTimeout(function () {
            impress().next();
        }, 700);
    });

    //星座
    touch.on('.xb-img', 'touchend', function (ev) {
        $(".td-dui").hide();
        $(this).parent().find(".td-dui").show();
        var xz = $(this).parent().find(".xb-img").attr("src").replace(".png", "").replace("images/", "");
        data.xingzuo = xz;
        xingzuomimi = xz;
        impress().next();
    });

    //择偶
    touch.on('#qc-1', 'touchend', function (ev) {
        $("#qc-dui-1").show();
        $("#qc-dui-2").hide();
        data.zeou = 0;//看胸
        $("#qc-dui-1").addClass("an-2");
        set();
        $("#success").hide();
        setTimeout(function () {
            impress().next();
        }, 800);
    });

    touch.on('#qc-2', 'touchend', function (ev) {
        $("#qc-dui-2").show();
        $("#qc-dui-1").hide();
        data.zeou = 1;//看脸
        $("#qc-dui-2").addClass("an-2");
        set();
        $("#success").hide();
        setTimeout(function () {
            impress().next();
        }, 800);
    });


    //提交
    touch.on('#submit', 'touchend', function (ev) {
        $.ajax({
            url: "save.php?openid=" + openid + "&data=" + JSON.stringify(data),
            type: "get",
            success: function (data1) {
                $("#success").show();
                $("#success").removeClass("animated bounceOutUp");
                $("#success").addClass("animated bounceInDown");
            }
        });

        wx.ready(function () {
            wx.onMenuShareTimeline({
                title: '大兴人择偶标准大调查,看脸还是看胸?', // 分享标题
                link: 'http://www.wexue.top/m6/login.php', // 分享链接
                imgUrl: 'http://www.wexue.top/m6/images/' + xingzuomimi + '.png', // 分享图标
                success: function () {
                    MtaH5.clickStat('shareCircle');
                },
                cancel: function () {
                }
            });
            wx.onMenuShareAppMessage({
                title: '大兴人择偶标准大调查,看脸还是看胸?', // 分享标题
                desc: '写调查,领奖品,看十二星座的择偶观', // 分享描述
                link: 'http://www.wexue.top/m6/login.php', // 分享链接
                imgUrl: 'http://www.wexue.top/m6/images/' + xingzuomimi + '.png', // 分享图标
                type: 'link', // 分享类型,music、video或link，不填默认为link
                dataUrl: '', // 如果type是music或video，则要提供数据链接，默认为空
                success: function () {
                    MtaH5.clickStat('shareFriend');
                    // 用户确认分享后执行的回调函数
                },
                cancel: function () {
                    // 用户取消分享后执行的回调函数
                }
            });
        });

    });

    touch.on('#again', 'touchend', function (ev) {
        impress().goto("xingbie");
    });

    touch.on('#close', 'touchend', function (ev) {
        $("#success").removeClass("animated bounceInDown");
        $("#success").addClass("animated bounceOutUp");
        setTimeout(function () {
            $("#success").hide();
        }, 700);
    });

}


function set() {
    //男
    if (data.xingbie == 0) {
        $("#fn-xb").text("帅哥");
    } else {
        $("#fn-xb").text("美女");
    }
    $("#fn-nl").text(data.nianling + "岁");
    $("#fn-sg").text(data.shengao + "CM");

    if (data.xuexing == 0) {
        $("#fn-xx").text("A型血");
    }
    if (data.xuexing == 1) {
        $("#fn-xx").text("B型血");
    }
    if (data.xuexing == 2) {
        $("#fn-xx").text("AB型血");
    }
    if (data.xuexing == 3) {
        $("#fn-xx").text("O型血");
    }

    if (data.xingzuo == "baiyang") {
        $("#fn-xz").text("白羊座");
    }
    if (data.xingzuo == "juxie") {
        $("#fn-xz").text("巨蟹座");
    }
    if (data.xingzuo == "mojie") {
        $("#fn-xz").text("摩羯座");
    }
    if (data.xingzuo == "sheshou") {
        $("#fn-xz").text("射手座");
    }
    if (data.xingzuo == "shizi") {
        $("#fn-xz").text("狮子座");
    }
    if (data.xingzuo == "shuangyu") {
        $("#fn-xz").text("双鱼座");
    }
    if (data.xingzuo == "shuangzi") {
        $("#fn-xz").text("双子座");
    }
    if (data.xingzuo == "shuiping") {
        $("#fn-xz").text("水瓶座");
    }
    if (data.xingzuo == "tianping") {
        $("#fn-xz").text("天秤座");
    }
    if (data.xingzuo == "tianxie") {
        $("#fn-xz").text("天蝎座");
    }
    if (data.xingzuo == "chunv") {
        $("#fn-xz").text("处女座");
    }
    if (data.xingzuo == "jinniu") {
        $("#fn-xz").text("金牛座");
    }

    if (data.zeou == 0 && data.xingbie == 0) {
        $("#fn-zo").text("爱大胸妹");
    }
    if (data.zeou == 1 && data.xingbie == 0) {
        $("#fn-zo").text("爱太平公主");
    }
    if (data.zeou == 0 && data.xingbie == 1) {
        $("#fn-zo").text("爱猛男");
    }
    if (data.zeou == 1 && data.xingbie == 1) {
        $("#fn-zo").text("爱靓仔");
    }

}

