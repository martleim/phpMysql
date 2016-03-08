
<script id="personEditForm" type="text/x-jquery-tmpl">
                    <form id="editForm" novalidate>
                        <input type="hidden" name="person_id" value="${person_id}" />
                        <div class="row">
                            <div class="col-md-4">
                                Nombre:
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="person_name" value="${person_name}" id="person_name" class="form-control" maxlength="50" required />
                                <span class="errorMessage">
                                    El campo nombre debe ser completado correctamente
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                Email:
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="person_email" id="person_email" value="${person_email}" class="form-control" maxlength="50" required />
                                <span class="errorMessage">
                                    El campo email debe ser completado correctamente
                                </span>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                Telefono:
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="person_telephone" id="person_telephone" value="${person_telephone}" class="form-control" maxlength="50" required />
                                <span class="errorMessage">
                                    El campo telefono debe ser completado correctamente
                                </span>
                            </div>
                        </div>
                        <button type="button" onclick="View.confirmForm()">Guardar</button>
                    </form>
</script>

<script id="peopleGrid" type="text/x-jquery-tmpl">
<div class="grid">
    <ul>
        {{tmpl($data.people) "#personListElement"}}
    </ul>
</div>
{{tmpl($data) "#pages"}}
</script>

<script id="pages" type="text/x-jquery-tmpl">
{{if pages > 1}}
    <div style="float:right;">
        <ul class="pagination">
            <li class="first-page"><a href="#" onclick="View.loadPage(0);">&laquo;</a></li>
            <li><a href="#" onclick="View.previousPage();">&lsaquo;</a></li>
            {{each(i,item) pagesArr}}
              <li><a href="#"  
                {{if currentPage==i}}
                     class="currentPage" 
                {{else}}
                     onclick="View.loadPage(${i});" 
                {{/if}}
                >${i+1}</a></li>
            {{/each}}
            <li><a href="#" onclick="View.nextPage();">&rsaquo;</a></li>
            <li class="last-page"><a href="#" onclick="View.loadPage(${lastPage});">&raquo;</a></li>
        </ul>
    </div>
{{/if}}
</script>

<script id="personListElement" type="text/x-jquery-tmpl">
<li>
    <div class="buttons">
        <div onclick="View.deletePerson(${person_id})">delete</div>
        <div onclick="View.editPerson(${person_id})">edit</div>
    </div>
    <input type="hidden" name="person_id" value="${person_id}" />
        <div class="field"><span class="fieldTitle">Nombre: </span>${person_name}</div>
        <div class="field"><span class="fieldTitle">Email: </span>${person_email}</div>
        <div class="field"><span class="fieldTitle">Telefono: </span>${person_telephone}</div>
        <div class="field"><span class="fieldTitle">Fecha Ingreso: </span>${person_date.split(" ")[0]}</div>
<li>
</script>