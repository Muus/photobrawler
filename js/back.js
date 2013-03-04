PhotoModel = Backbone.Model.extend({
    urlRoot:'inc/api.php?give_me=photos',
    url: 'inc/api.php?give_me=photos',
    defaults: {},
});

PhotoCollection = Backbone.Collection.extend({ 
    urlRoot:'inc/api.php?give_me=photos',
    model:PhotoModel,
    url: 'inc/api.php?give_me=photos',
});

AccountsModel = Backbone.Model.extend({
    urlRoot:'inc/api.php?give_me=accounts',
    url: 'inc/api.php?give_me=accounts',
    defaults: {},
});

AccountsCollection = Backbone.Collection.extend({ 
    urlRoot:'inc/api.php?give_me=accounts',
    model:AccountsModel,
    url: 'inc/api.php?give_me=accounts',
});

PhotoView = Backbone.View.extend({
    tagName:"img",
    className:'',
    templateHtml:"",

    events:{
        "click":"onClick",
        //"click": "onClick",
    },

    initialize:function () {
        this.template = _.template(this.templateHtml);
        this.render();
    },

    render:function () {
        this.thumblink = this.model.get('thumblink');
        this.link = this.model.get('link');
        this.id = this.model.get('id');
        if (this.model.get('public') === 1){
            this.$el.attr('src', this.thumblink).attr('true_link', this.link).html(this.template(this.model.toJSON()));
            this.$el.attr('src', this.thumblink).attr('thumb_id', this.id).html(this.template(this.model.toJSON()));
        } else {
            this.$el.attr('src', this.thumblink).attr('true_link', this.link).attr('class', 'notPublic').html(this.template(this.model.toJSON()));
        }
        if (this.model.get('public') === 0 && !logged_in_user) {
            $(this.$el).hide();
        }
    },
    
    
    onClick:function (e) {
        
        if ($('#bigPhoto').length > 0) {
            // Already one active photo
        } else {
            $('#lozz').append('<img id="bigPhoto" src="' + this.link + '" />');
            $('#bigPhoto').on('click', function () {
                $(this).remove();
            });
        }
    },
    
    onDestroy:function () {
        modelId = this.model.get('id');
        link = this.model.get('link');
        thumblink = this.model.get('thumblink');
        var el = this.$el;
        //Need these headers to complete the desired delete
        this.model.destroy({headers:{
            'id' : modelId,
            'link' : link,
            'thumblink' : thumblink,
        },
        success: function(removed_person, data) {
            $(el).hide();
            console.log('jj');
        },
        error: function(aborted_person, response) {
            console.log(aborted_person);
            console.log(response);
            // Error handling as needed.
        }});  
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

GalleryView = Backbone.View.extend({
    tagName:'div',
    className:'',
    templateHtml:"<div></div>",
    initialize:function () {
        this.template = _.template(this.templateHtml);
        this.render();
        console.log('fee');
        console.log(this.photoCollection);
    },
    
    render:function () {
        this.$el.html(this.template());
        var _this = this;
        this.photoCollection = new PhotoCollection();
        this.photoCollection.fetch({data:{'limit':0}, success:function () {
            var standardLength = _this.photoCollection.models.length;
            var newLength;
            function rerun(){
                setTimeout(function(){
                    _this.photoCollection.fetch({data:{'limit':0}, success:function () {
                        newLength = _this.photoCollection.models.length;
                        if(newLength > standardLength){
                            standardLength = newLength;
                            console.log('tja');
                            newMod = _this.photoCollection.last();
                            console.log(newMod);
                            if(newMod.get('public') === 1){
                                var view = new PhotoView({model:newMod});
                                jQuery("#photoGrid").append(view.$el);
                            } else {
                                var view = new PhotoView({model:newMod});
                                jQuery("#photoGrid").append(view.$el);
                            }
                        }
                    }});
                    rerun();
                },1000);
            }
            rerun();
            console.log(standardLength);
            _.each(_this.photoCollection.models, function (elem) {
                console.log(elem.get('name'));
                if(elem.get('public') === 1){
                    var view = new PhotoView({model:elem});
                    jQuery("#photoGrid").append(view.$el);
                } else {
                    var view = new PhotoView({model:elem});
                    jQuery("#photoGrid").append(view.$el);
                }
            });
        }});
        console.log('render');
    },
});

//Accountmodel n collection
SingleAccountsView = Backbone.View.extend({
    tagName:"form",
    className:'',
    templateHtml:'<input name="email" type="email" value="<%= email %>">'
    +'<input name="phonenumber" value="<%= phonenumber %>">'
    +'<input name="street_address" value="<%= street_address %>">'
    +'<input name="postal_code" type="" value="<%= postal_code %>">'
    +'<input name="city" type="" value="<%= city %>">'
    +'<input name="province" type="" value="<%= province %>">'
    +'<input name="state" type="" value="<%= state %>">'
    +'<input name="country" type="" value="<%= country %>">'
    +'<input name="info" type="" value="<%= info %>">',
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
            var standardLength = _this.accountsCollection.models.length;
            var newLength;
            /*
            function rerun(){
                setTimeout(function(){
                    _this.photoCollection.fetch({data:{'limit':0}, success:function () {
                        newLength = _this.photoCollection.models.length;
                        if(newLength > standardLength){
                            standardLength = newLength;
                            console.log('tja');
                            newMod = _this.photoCollection.last();
                            console.log(newMod);
                            if(newMod.get('public') === 1){
                                var view = new PhotoView({model:newMod});
                                jQuery("#lozz").append(view.$el);
                            }else{
                                var view = new PhotoView({model:newMod});
                                jQuery("#lozz").append(view.$el);
                            }
                        }
                    }});
                    rerun();
                },1000);
            }
            rerun();*/
            console.log(standardLength);
            _.each(_this.accountsCollection.models, function (elem) {
                console.log(elem.get('email'));
                var view = new SingleAccountsView({model:elem});
                //Change later to other div
                jQuery("#lozz").append(view.$el);
            });

        }});
        console.log('render');
    },
});

var lol = new GalleryView({ el: $("#photoGrid") });
//var lol = new AccountsView({ el: $("#lozzAcc") });

//Lets do both checks inside the success for projects, because this seems to take much more time.
