PhotoModel = Backbone.Model.extend({
 urlRoot:'inc/api.php',
  url: 'inc/api.php',
  defaults: {

  }
   })

PhotoCollection = Backbone.Collection.extend({ urlRoot:'inc/api.php', model:PhotoModel, url: 'inc/api.php', });


EstimateItemView = Backbone.View.extend({
    tagName:"img",
    className:'',
    templateHtml:"",
    events:{

        "focus":"onFocus",


    },

    initialize:function () {


        this.template = _.template(this.templateHtml);
        this.render();
    },
    render:function () {
      console.log('itemrendered');
        this.id = this.model.get('name').week;
        this.link = this.model.get('link');

        this.$el.attr('src', this.link).html(this.template(this.model.toJSON()));


    },
    onFocus:function () {


        


        //console.log(ourElem);
    },
    
    
});





PersonView = Backbone.View.extend({
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
         _.each(_this.photoCollection.models, function (elem) {
            
              console.log(elem.get('name'));
              var view = new EstimateItemView({model:elem});
            jQuery("#lozz").append(view.$el);
        });
          
        
        
    
        }});
     console.log('render');
        
       
        

      
        
    },


   
    });

var lol = new PersonView({ el: $("#lozz") });

                    //Lets do both checks inside the success for projects, because this seems to take much more time.
 
