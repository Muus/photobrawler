

PhotoModel = Backbone.Model.extend({
 urlRoot:'inc/api.php',
  url: 'inc/api.php',
  defaults: {

  }
   });

PhotoCollection = Backbone.Collection.extend({ urlRoot:'inc/api.php', model:PhotoModel, url: 'inc/api.php', });


EstimateItemView = Backbone.View.extend({
    tagName:"img",
    className:'temp-photo',
    templateHtml:"",
    events:{

        "click":"onDestroy",
       


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
        if(this.model.get('public') === 0){
          $(this.$el).hide();
        }


    },
    onClick:function () {
     
    },
    onDestroy:function () {
      
      modelId = this.model.get('id');
      link = this.model.get('link');
      var el = this.$el;
    
      this.model.destroy({headers:{
        'id' : modelId,
        'link' : link,
    },
          success: function(removed_person, data) {
             $(el).hide();
              console.log('jj');
              

          },
          error: function(aborted_person, response) {
            console.log(aborted_person);
            console.log(response);
              // Error handling as needed.
          }
      });
      
    },onChangePublic:function () {
      alert('swipe');
      modelId = this.model.get('id');
      var el = this.$el;
      this.model.set('public', 0);
      this.model.save();
      this.render();
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
              if(elem.get('public') === 1){
              var view = new EstimateItemView({model:elem});
            jQuery("#lozz").append(view.$el);
          }
        });
          
        
        
    
        }});
     console.log('render');
        
       
        

      
        
    },


   
    });

var lol = new PersonView({ el: $("#lozz") });

                    //Lets do both checks inside the success for projects, because this seems to take much more time.
 
