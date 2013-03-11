//This is a "temporary" variable which controls the admins possibility to (change public status, delete photos)
var masterMode = 0;

//new function with the dropdown
$('#delMode ,#pubMode').bind('click', function() {
    //If masterMode is 0 it means safe mode,
    //This iterates between all the possible values to choose the next if the button is clicked
    //it also changes the text on the button
    console.log($(this).prop('id'));
    if($(this).prop('id') == 'delMode') {
        if(masterMode == 2){
            masterMode = 0;
            $(this).html('Delete mode is off');
        } else if (masterMode == 0 || masterMode == 1) {
            console.log('2');
            masterMode = 2;
            $(this).html('Delete mode is on');
            $('#pubMode').html('Public/Unpublic mode is off');
        }
    } else if ($(this).prop('id') == 'pubMode') {
        if(masterMode == 1){
            masterMode = 0;
            $(this).html('Public/Unpublic mode is off');
        } else if (masterMode == 0 || masterMode == 2) {
            console.log('1');
            masterMode = 1;
            $(this).html('Public/Unpublic mode is on');
            $('#delMode').html('Delete mode is off');
        }   
    }
});

//
PhotoModel = Backbone.Model.extend({
    urlRoot:'/photobrawler/inc/api.php?give_me=photos',
    url: '/photobrawler/inc/api.php?give_me=photos',
    defaults: {},
});

PhotoCollection = Backbone.Collection.extend({ 
    urlRoot:'/photobrawler/inc/api.php?give_me=photos',
    model:PhotoModel,
    url: '/photobrawler/inc/api.php?give_me=photos',
    comparator:function (m) {
        return -m.get('id');
    },
});

AccountsModel = Backbone.Model.extend({
    urlRoot:'/photobrawler/inc/api.php?give_me=accounts',
    url: '/photobrawler/inc/api.php?give_me=accounts',
    defaults: {},
});

AccountsCollection = Backbone.Collection.extend({ 
    urlRoot:'/photobrawler/inc/api.php?give_me=accounts',
    model:AccountsModel,
    url: '/photobrawler/inc/api.php?give_me=accounts',
});

//View for each photo in the grid on the first page, the galleryview loops out this view
PhotoView = Backbone.View.extend({
    tagName:"div",
    className:'photoInGallery',
    templateHtml:"<img id=<%= id %> class='inGallery' src='<%= thumblink %>'>",
//Probably should have click instead of click
events:{
    "click":"onClick",

},

initialize:function () {
    this.template = _.template(this.templateHtml);
    this.render();
},

render:function () {
//Render the picture 
this.thumblink = this.model.get('thumblink');
this.link = this.model.get('link');
this.id = this.model.get('id');
//If the model is for public viewing
if (this.model.get('public') === 1){
    //dont set the class, or null it if it was notpublic before
    //and some other stuff
    this.$el.attr('thumb_id', this.id).attr('src', this.thumblink).attr('true_link', this.link).attr('class', '').html(this.template(this.model.toJSON()));
    //Not for public viewing
} else {
    //set the class notpublic
    //and some other stuff
    this.$el.attr('thumb_id', this.id).attr('src', this.thumblink).attr('true_link', this.link).attr('class', 'notPublic').html(this.template(this.model.toJSON()));
}
if (this.model.get('public') === 0 && !logged_in_user) {
    //if its not a public photo and the user is not logged in(admin), hide it.
    $(this.$el).hide();
}
//if a loader was up, hide it
$.mobile.loading( 'hide' );
},

onClick:function (e) {
    //2 means delete mode
    if(masterMode === 2){
        console.log('destroy');
        this.onDestroy();
        //0 means safemode and should only transition to the single photoview
    }else if(masterMode === 0){
        $.mobile.loading( 'show' );
        //which photo to show in the single view
        var LastKnown = this.model;
        path = 'singlephoto/index.php?phid='+this.model.get('link')+'&name='+this.model.get('name');

        //
        $.mobile.loadPage( ""+path+"" );

        setTimeout(function () {
             $('#dude').imagesLoaded({
                    done: function ($images) {$.mobile.changePage( "#singelphoto", { transition: "slide"} );
                    //your script, and potentially testing you are on a page requiring it

                    console.log('after changepage');

                    var lls = LastKnown;

                    $('.photoTitle').html(lls.get('name'));
                    $('.photoDescription').html(lls.get('description'));

                    if(!logged_in_user){

                    }else{
                        $('.photoTitle, .photoDescription').prop('contenteditable','true').bind('blur', function(){
                            lls.set({'name':$('.photoTitle').html(), 'description': $('.photoDescription').html()});
                            lls.save();
                        });
                    }

                    setTimeout(function () {
                        console.log('lol');
                    }, 2000);

                    },
                fail: function ($images, $proper, $broken) {},
                always: function () {},
                progress: function (isBroken, $images, $proper, $broken) {console.log('something up');}
            });

        }, 200);

        //1 means change public status
    }else if(masterMode === 1){
        this.onChangePublic();
    }
},

onDestroy:function () {
    var newThis = this;
    $('<div>').simpledialog2({
        mode: 'button',
        zindex: '9999',
        buttonPrompt: 'Really delete this photo?',
        buttons: {
            'Confirm': {
                click: function () {
                    modelId = newThis.model.get('id');
                    link = newThis.model.get('link');
                    thumblink = newThis.model.get('thumblink');
                    var el = newThis.$el;
                    newThis.model.destroy({
                        headers:{
                            'id' : modelId,
                            'link' : link,
                            'thumblink' : thumblink,
                        },
                        success: function(removed_person, data) {
                            $(el).hide();
                        },
                        error: function(aborted_person, response) {
                            console.log(aborted_person);
                            console.log(response);
                            // Error handling as needed.
                        }
                    }); 
                },
                theme: 'b'
            },
            'Cancel': {
                click: function () {
                    // Do nothing, cancel deletion       
                },
                icon: 'delete',
                theme: 'c'
            },
        }
    }) 
},

onChangePublic:function () {
    $.mobile.loading( 'show' );
    modelId = this.model.get('id');
    var el = this.$el;
//switch between 1 and 0 
if(this.model.get('public') == 1){
    this.model.set('public', 0);
}else{
    this.model.set('public', 1);
}
this.model.save();
this.render();
},


});
//This view is used to put out all the singlephotos after fetch
GalleryView = Backbone.View.extend({
    tagName:'div',
    
    templateHtml:"<div></div>",
    initialize:function () {
        this.template = _.template(this.templateHtml);
        this.render();
    },

    render:function () {
        this.$el.html(this.template());
        var _this = this;
        this.photoCollection = new PhotoCollection();
        this.photoCollection.fetch({data:{'limit':0}, success:function () {
    //Put out all of the photos in seperate views
    _.each(_this.photoCollection.models, function (elem) {
        var view = new PhotoView({model:elem});
        jQuery("#photoGrid").append(view.$el);
        
    });
}});
    },
});
tempIfLoggedIn = '<input name="email" type="email" value="<%= email %>">'
    +'<input name="phonenumber" value="<%= phonenumber %>">'
    +'<input name="street_address" value="<%= street_address %>">'
    +'<input name="postal_code" type="" value="<%= postal_code %>">'
    +'<input name="city" type="" value="<%= city %>">'
    +'<input name="province" type="" value="<%= province %>">'
    +'<input name="state" type="" value="<%= state %>">'
    +'<input name="country" type="" value="<%= country %>">'
    +'<input name="info" type="" value="<%= info %>">';

tempIfNot = '<p> <%= email %></p>'
    +'<p> <%= phonenumber %></p>'
    +'<p> <%= street_address %></p>'
    +'<p> <%= postal_code %></p>'
    +'<p> <%= city %></p>'
    +'<p> <%= province %></p>'
    +'<p> <%= state %></p>'
    +'<p> <%= country %></p>'
    +'<p> <%= info %></p>';
//Accountmodel n collection
if(!logged_in_user){

    useForTemp = tempIfNot;
}else{
    useForTemp =tempIfLoggedIn;
}
SingleAccountsView = Backbone.View.extend({
    tagName:"form",
    className:'',
    templateHtml: useForTemp,
    events:{
//"click":"onDestroy",
"focusout":"onBlur",
"focus":"onFocus",
"click":"onFocus",
},

initialize:function () {
    this.template = _.template(this.templateHtml);
    this.render();
},

render:function () {
//this.thumblink = this.model.get('thumblink');
//this.link = this.model.get('link');
this.$el.html(this.template(this.model.toJSON()));
},

onBlur:function () {
    console.log('blurred');
    disName = $(this);
    console.log(disName);
    this.model.set('phonenumber', $('[name=phonenumber]').val() );
    this.model.set('street_address', $('[name=street_address]').val() );
    this.model.set('postal_code', $('[name=postal_code]').val() );
    this.model.set('city', $('[name=city]').val() );
    this.model.set('province', $('[name=province]').val() );
    this.model.set('state', $('[name=state]').val() );
    this.model.set('country', $('[name=country]').val() );
    this.model.set('info', $('[name=info]').val() );
    this.model.save();
},

onFocus:function () {
    console.log('focused');
    disName = $(this).text();
    console.log(disName);
},

onChangePublic:function () {
    alert('swipe');
    modelId = this.model.get('id');
    var el = this.$el;
    this.model.set('public', 0);
    this.model.save();
    this.render();
//console.log(ourElem);
},
});

AccountsView = Backbone.View.extend({
    tagName:'div',
    className:'',
    templateHtml:"<div></div>",

    initialize:function () {

        this.template = _.template(this.templateHtml);
        this.render();
        console.log('fee');
        console.log(this.accountsCollection);
    },

    render:function () {
        this.$el.html(this.template());
        var _this = this;
        this.accountsCollection = new AccountsCollection();
        this.accountsCollection.fetch({data:{'limit':0}, success:function () {
            _.each(_this.accountsCollection.models, function (elem) {
                console.log(elem.get('email'));
                var view = new SingleAccountsView({model:elem});
        //Change later to other div
        jQuery("#infoPers").append(view.$el);
    });

        }});
        console.log('render');
    },
});


var lol = new GalleryView({ el: $("#photoGrid") });
var lol = new AccountsView({ el: $("#infoPers") });

//Lets do both checks inside the success for projects, because this seems to take much more time.
