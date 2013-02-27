

PhotoModel = Backbone.Model.extend({
  urlRoot:'inc/api.php',
  url: 'inc/api.php',
  defaults: {},
});

PhotoCollection = Backbone.Collection.extend({ 
  urlRoot:'inc/api.php',
  model:PhotoModel,
  url: 'inc/api.php',
});


EstimateItemView = Backbone.View.extend({
  tagName:"img",
  className:'',
  templateHtml:"",
  events:{
        "click":"onDestroy",
  },

    initialize:function () {
        this.template = _.template(this.templateHtml);
        this.render();
    },
    render:function () {
        this.thumblink = this.model.get('thumblink');
        this.link = this.model.get('link');
        if(this.model.get('public') === 1){
          this.$el.attr('src', this.thumblink).attr('true_link', this.link).html(this.template(this.model.toJSON()));
        }else{
          this.$el.attr('src', this.thumblink).attr('true_link', this.link).attr('class', 'notPublic').html(this.template(this.model.toJSON()));
        }
        if(this.model.get('public') === 0 && !logged_in_user){

          $(this.$el).hide();
        }


    },
    onClick:function () {
     
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
                var view = new EstimateItemView({model:newMod});
              jQuery("#lozz").append(view.$el);
          }else{
            var view = new EstimateItemView({model:newMod});
              jQuery("#lozz").append(view.$el);

          }
            }



          }

        });

          rerun();
        },1000);
      }
      rerun();
      console.log(standardLength);
         _.each(_this.photoCollection.models, function (elem) {
            
              console.log(elem.get('name'));
              if(elem.get('public') === 1){
              var view = new EstimateItemView({model:elem});
            jQuery("#lozz").append(view.$el);
          }else{
            var view = new EstimateItemView({model:elem});
              jQuery("#lozz").append(view.$el);

          }
        });
          
        
        
    
        }});
     console.log('render');
        
       
        

      
        
    },


   
    });

var lol = new GalleryView({ el: $("#lozz") });

                    //Lets do both checks inside the success for projects, because this seems to take much more time.
 
