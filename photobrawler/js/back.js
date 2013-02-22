PhotoModel = Backbone.Model.extend({
 urlRoot:'inc/api.php',
  url: 'inc/api.php',
  defaults: {

  }
   })

PhotoCollection = Backbone.Collection.extend({ urlRoot:'inc/api.php', model:PhotoModel, url: 'inc/api.php', });


PersonView = Backbone.View.extend({
    tagName:'div',
    
    templateHtml:"<div></div>",

    initialize:function () {
        this.template = _.template(this.templateHtml);
        var _this = this;
    	this.photoCollection = new PhotoCollection();
    	this.photoCollection.fetch({data:{'limit':0}, success:function () {
    		
    			_.each(_this.photoCollection.models, function (elem) {
    				
    	        console.log(elem.get('name'));
            
        });
    		
    		
		
        }});
        this.render();
        
       
        
        console.log('fee');
        console.log(this.photoCollection);
    },
    render:function () {
     
        this.$el.html(this.template());

      
        
    },


   
    });

var lol = new PersonView();

                    //Lets do both checks inside the success for projects, because this seems to take much more time.
 
