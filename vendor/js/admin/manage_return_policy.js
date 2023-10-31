var code_ajax = $("#code_ajax").val();
var pageno = 1;
var rowno = 0;


function getreturn_policy(pagenov, rownov) {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_return_policy_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: rownov,
            perpage: perpage
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				var  btnactive ="";
                if(this.statuss == "0"){
                	    btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
                }else if(this.statuss == "1"){
                	    btnactive= '<spanclass = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "3"){
                	    btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 	
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.title + '</td><td > ' +btnactive+ '</td>';
				html += '<td><button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'view_records("'+this.id +'")\';>View</button><div class="policy' +this.id + '" style="display:none;">' +this.policy+ '</div></td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });

        }
    });
}

function view_records(id) {
	$("#myModalupdate").modal('show');
	
	var htm = $(".policy"+id).text();
	//$("#update_policy_content").html(htm);
    // tinymce.activeEditor.setContent(htm);
    tinymce.activeEditor.setContent(htm);
}

function attribute_set_product(pagenov) {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        url: 'get_tax_class_data.php',
        data: {
            code: code_ajax,
            page: pagenov,
            rowno: 0,
            perpage: perpage
        },
        success: function(response) {
            $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				var  btnactive ="";
                if(this.statuss == "0"){
                	    btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
                }else if(this.statuss == "1"){
                	    btnactive= '<spanclass = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "3"){
                	    btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 	
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.title + '</td><td > ' +btnactive+ '</td>';
				html += '<td><button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'view_records("'+this.id +'")\';>View</button><div class="policy' +this.id + '" style="display:none;">' +this.policy+ '</div></td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });
		}
    });
}


$(document).ready(function() {
    getreturn_policy(pageno, rowno);
	
	
	$("#add_policy_btn").click(function(event){
		event.preventDefault();
		
		var policy_title = $('#policy_title').val();
		var policy_content = tinyMCE.get('policy_content').getContent();
		
		if(!policy_title){
			successmsg("Please enter policy title.");
		}
		if(!policy_content){
			successmsg("Please enter policy details.");
		}
		
		if(policy_content && policy_title){				
			$.busyLoadFull("show");
			var form_data = new FormData();
			form_data.append('policy_title', policy_title);
			form_data.append('policy_content', policy_content);
			form_data.append('code', code_ajax);
			
			$.ajax({
				method: 'POST',
				url: 'add_policy_process.php',
				data:form_data,
				contentType: false,
				processData: false,
				success: function(response){
					$.busyLoadFull("hide");
					$("#myModal").modal('hide');
					$('#policy_title').val('');
					tinyMCE.activeEditor.setContent('');
					getreturn_policy(1, 0)
					successmsg(response);	

				}
			});
		}
			
    });
	
	
	if ($("#policy_content").length > 0) {
        tinymce.init({
            selector: "textarea#policy_content",
            theme: "modern",
            height: 300,
            plugins: [
				"advlist lists print",
			//  "wordcount code fullscreen",
				"save table directionality emoticons paste textcolor"
			],
			toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }
	
	if ($("#update_policy_content").length > 0) {
        tinymce.init({
            selector: "textarea#update_policy_content",
            theme: "modern",
            height: 300,
            plugins: [
				"advlist lists print",
			//  "wordcount code fullscreen",
				"save table directionality emoticons paste textcolor"
			],
			toolbar: " undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",

        });
    }
	

});



function perpage_filter() {
	$.busyLoadFull("show");
    var perpage = $('#perpage').val();
    // successmsg( "sdfs" );
    var count = 1;
    $.ajax({
        method: 'POST',
        // url: 'get_country_data.php',
        url: 'get_return_policy_data.php',
        data: {
            code: code_ajax,
            page: 1,
            rowno: 0,
            perpage: perpage
        },
        success: function(response) {
           $.busyLoadFull("hide");
            var parsedJSON = $.parseJSON(response);
            $("#cat_list").empty();           

            $("#totalrowvalue").html(parsedJSON["totalrowvalue"]);
            $(".page_div").html(parsedJSON["page_html"]);
			
			var data = parsedJSON.data;
            $(data).each(function() {
				var  btnactive ="";
                if(this.statuss == "0"){
                	    btnactive=	'<span class = "Pending">'+"Pending"+'</span>';
                }else if(this.statuss == "1"){
                	    btnactive= '<spanclass = "Active">'+"Active "+'</span>';
                }else if(this.statuss == "3"){
                	    btnactive=	'<span class = "Deactive">'+"Deactive"+'</span>';
                } 	
				
                var html = '<tr id="tr' + this.id + '"> <td>' + count + '</td><td > ' + this.title + '</td><td > ' +btnactive+ '</td>';
				html += '<td><button  style=" margin-left: 10px;" type="submit" class="btn btn-dark waves-effect waves-light btn-sm pull-left" name="edit" onclick=\'view_records("'+this.id +'")\';>View</button><div class="policy' +this.id + '" style="display:none;">' +this.policy+ '</div></td>';
                html += '</tr>';
                $("#cat_list").append(html);

                count = count + 1;
            });



        }
    });
}



	