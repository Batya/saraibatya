var core = {
    route: {
        dpm: "/app/modules/dpm/"
    },
    views: {
        js: function(module,file) {return core.route.dpm+module+"/js/"+file},
        views: function(module,file) {return core.route.dpm+module+"/views/"+file},
        blocks: function(module,file) {return core.route.dpm+module+"/views/blocks/"+file},
        controllers: function(module,file) {return core.route.dpm+module+"/controllers/"+file},
        Models: function(module,file) {return core.route.dpm+module+"/Models/"+file}
    },
    sendMessage: function(ev,id) {
        ev.preventDefault();
        alert('coming soon...view console');
        console.log({'core.js':'sendMessage(ev,id)'});
    },
    viewMember: function(id,ev) {
        if(ev !== undefined)
            ev.preventDefault();
        $.post(_d.api+'get/user?access='+_d.session,{
            user:{
                only:"bio,username,f_name,l_name,img,email,quote",
                from:"user",
                where:"user_id = "+id
            }
        },function(user) {
            user = user.user[0];
            var m = '';
            m+='<div class="col s12">';
            m+='<div class="row">';
            m+='<div class="col s12 m6">';
            m+='<div style="background: url(\'/'+user.img+'\') center/cover;height:200px;width:200px;margin:0 auto;border-radius:50%;"></div>';
            m+='</div>';
            m+='<div class="col s12 m6">';
            m+='<div class="section">';
            m+='<h5>'+user.f_name+' '+user.l_name+'</h5>';
            m+='<p>'+user.email+'</p>';
            m+='</div>';
            m+='<div class="divider"></div>';
            m+='<div class="section">';
            m+='<p>'+user.quote+'</p>';
            m+='</div>';
            m+='<div class="divider"></div>';
            m+='<div class="section">';
            m+='<p>'+user.bio+'</p>';
            m+='</div></div></div></div>';
            _d.modal({
                header:'<div style="text-align: center;padding-bottom:10px;border-bottom:1px solid #aaa;margin-bottom:10px;">'+user.username+'</div>',
                content:m,
                footerFixed: true
            },function(){});
        });
    },
    loadPage: function() {
        var url = core.urlParams();
        var view = $("div#dpm-view");
        if(url.view.length > 0){
            console.log('has a view:',core.views.views(url.module,url.view+'.phtml'));
            view.load(core.views.views(url.module,url.view+'.phtml'),function(view){console.log(view);});
        }else{
            console.log('has no view:',core.views.views(url.module,'index.phtml'));
            view.load(core.views.views(url.module,'index.phtml'),function(){});
        }
    },
    urlParams: function() {
        var route = location.hash,newRoute = [],routePath = {};
        route = route.replace('#','').split('/');
        routePath = {module: route[0],view: route[1],params:{}};
        delete route[0];
        delete route[1];
        if(route[3])
            routePath.params[route[2]] = route[3];
        if(route[5])
            routePath.params[route[4]] = route[5];
        if(route[7])
            routePath.params[route[6]] = route[7];
        return routePath;
    }
};

// core.loadPage();