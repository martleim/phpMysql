var PeopleController;
(function(Controller){
    
    Controller.pages=0;
    Controller.people=0;
    
    Controller.baseUrl=Config.dataAccessBaseUrl+"people.php";
    
    Controller.createUrl=Controller.baseUrl+"?action=create";
    Controller.updateUrl=Controller.baseUrl+"?action=update";
    Controller.deleteUrl=Controller.baseUrl+"?action=delete";
    Controller.pagesUrl=Controller.baseUrl+"?action=pages";
    Controller.pagedPeopleUrl=Controller.baseUrl+"?page=";
    
    Controller.createPerson=function(data){
        this.post(this.createUrl,data,function(data){
            Controller.success();
        });
    }
    
    Controller.updatePerson=function(data){
        this.post(this.updateUrl,data,function(data){
            Controller.success();
        });
    }
    
    Controller.deletePerson=function(data){
        this.post(this.deleteUrl,data,function(data){
            Controller.success();
        });
    }
    
    Controller.getPages=function(){
        this.post(this.pagesUrl,null,function(data){
            Controller.pages=data.result;
            Controller.success("PAGE_NUMBERS_LOADED");
        });
    }

    Controller.getPagedPeople=function(page){
        this.post(this.pagedPeopleUrl+page,null,function(data){
            Controller.people=data.result; 
            Controller.success("PEOPLE_PAGE_LOADED");
        });
    }
    
    Controller.success=function(event){
        event=(event||"SUCCESS");
        $(this).trigger( event );
    }
    
    Controller.fail=function(data){
        $(this).trigger( "FAIL", data );
    }
    
    Controller.post=function(url,data,success){
        $.ajax({
            type: "POST",
            url: url,
            data: JSON.stringify(data),
            complete: function(data){
                success(JSON.parse(data.responseText));
            },
            dataType: "application/json",
            accept: "application/json"
        }).fail(this.fail);
    }
    
})(PeopleController||(PeopleController={}));