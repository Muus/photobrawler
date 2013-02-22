PersonModel = Backbone.Model.extend({
 urlRoot:'inc/api.php',
  url: 'inc/api.php',
  defaults: {
    id:null,
  	email:null,
  	password:null,
  }
   })

PersonCollection = Backbone.Collection.extend({ urlRoot:'inc/api.php', model:PersonModel, url: 'inc/api.php', });


PersonView = Backbone.View.extend({
    tagName:'div',
    
    templateHtml:"<div></div>",

    initialize:function () {
        this.template = _.template(this.templateHtml);
        var _this = this;
    	this.personCollection = new PersonCollection();
    	this.personCollection.fetch({data:{'limit':0}, success:function () {
    		
    			_.each(_this.personCollection.models, function (elem) {
    				
    	        console.log(elem.get('email'));
            
        });
    		
    		
		
        }});
        this.render();
        
       
        
        console.log('fee');
        console.log(this.personCollection);
    },
    render:function () {
     
        this.$el.html(this.template());

      
        
    },


   
    });

var lol = new PersonView();

                    //Lets do both checks inside the success for projects, because this seems to take much more time.
 
