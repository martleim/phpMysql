var View;
(function(View){
    
    View.edit=false;
    
    View.currentPage=0;
    View.pages=0;
    View.pagesArr=[];
    
    View.people=0;
    
    View.getCurrentPage=function(){
        PeopleController.getPages();
        PeopleController.getPagedPeople(this.currentPage);
    }
    
    View.loadPage=function(num){
        this.currentPage=num;
        this.getCurrentPage();
    }
    
    View.previousPage=function(){
        this.currentPage--;
        if(this.currentPage<0){
            this.currentPage=0;
        }
        View.getCurrentPage();
    }
    
    View.nextPage=function(){
        this.currentPage++;
        if(this.currentPage<=this.pages){
            this.currentPage=this.pages-1;
        }
        View.getCurrentPage();
    }
    
    View.confirmForm=function(){
        if(this.validateForm()){
            var data=View.serializeForm();
            if(this.edit){
                PeopleController.updatePerson(data);
            }else{
                PeopleController.createPerson(data);
            }
            this.setPersonEditForm();
            this.edit=false;
        }
    }
    
    View.deletePerson=function(id){
        var person=this.getPerson(id);
        if(confirm("Esta seguro que desea eliminar a "+person.person_name+"?")){
            PeopleController.deletePerson(person);
        }
        
    }
    
    View.editPerson=function(id){
        var person=this.getPerson(id);
        if(confirm("Esta seguro que desea editar a "+person.person_name+"?")){
            this.edit=true;
            this.setPersonEditForm(person);
        }
    }
    
    View.getPerson=function(id){
        var ret;
        $.each(this.people, function( index, person ) {
            if(person.person_id==id){
                ret=person;
                return;
            }
        });
        return ret;
    }
    
    View.validateForm=function(){
        this.hideValidationErrors();
        var data=View.serializeForm();
    
        if(data.person_name==""){
            this.showValidationError("person_name");
            return false;
        }
        
        var emailRegEx = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(!emailRegEx.test(data.person_email)){
            this.showValidationError("person_email");
            return false;
        }
        
        var telephoneRegEx = /^\d+$/;
        if(!telephoneRegEx.test(data.person_telephone)){
            this.showValidationError("person_telephone");
            return false;
        }
        
        return true;
        
    }
    
    View.showValidationError=function(where){
        $("#"+where).next().css("visibility","visible").hide().fadeIn("slow");
    }
    
    View.hideValidationErrors=function(where){
        $("#person_name").next().css("visibility","hidden");
        $("#person_email").next().css("visibility","hidden");
        $("#person_telephone").next().css("visibility","hidden");
    }
    
    View.setPersonEditForm=function(person){
        $("#personEditFormContainer").html("");
        $("#personEditForm").tmpl(person).appendTo("#personEditFormContainer");
        $("#personEditFormContainer").hide().fadeIn("slow");
    }
    
    View.serializeForm=function(){
        var data=$("#editForm").serializeArray();
        var ret={};
        $.each(data, function( index, value ) {
            ret[value.name]=value.value;
        });
        return ret;
    }
    
    View.refreshGrid=function(){
        View.pages=PeopleController.pages;
        View.people=PeopleController.people;
        View.pagesArr=[];
        for(var i=0;i<View.pages;i++){
            View.pagesArr.push(i);
        }
        $("#peopleGridContainer").html("");
        $("#peopleGrid").tmpl(View).appendTo("#peopleGridContainer");
        $("#peopleGridContainer").hide().fadeIn("slow");
        
    }
    
    
    View.initialize=function(){
        
        $(PeopleController).bind("PAGE_NUMBERS_LOADED",this.refreshGrid);
        $(PeopleController).bind("PEOPLE_PAGE_LOADED",this.refreshGrid);
        $(PeopleController).bind("SUCCESS",View.getCurrentPage);
        
        this.setPersonEditForm();
        this.getCurrentPage();
    }
    
})(View||(View={}));