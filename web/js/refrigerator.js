var BaseRecord=(function() {
$(document).ready(function() {
$("body").on("click", ".button_add", function(){BaseRecord.validate($(this).attr("name"), $(this).attr("id"), $(".name_title").val(), $(".buy_date").val(), $(".make_date").val(), $(".limit_date").val());});
$("body").on("keypress", ".name_title, .buy_date, .make_date, .limit_date", function(event){if(event.which==13){BaseRecord.validate($(".button_add").attr("name"), $(".button_add").attr("id"), $(".name_title").val(), $(".buy_date").val(), $(".make_date").val(), $(".limit_date").val()); return false;}});
$("body").on("click", ".fa-update", function(){
   $(".title_error").html("&nbsp;");  //???
   $(".name_title").val($("[data-key='"+$(this).attr("name")+"']").children("td:eq(1)").html());
   $(".buy_date").val($("[data-key='"+$(this).attr("name")+"']").children("td:eq(2)").html());
   $(".make_date").val($("[data-key='"+$(this).attr("name")+"']").children("td:eq(3)").html());
   $(".limit_date").val($("[data-key='"+$(this).attr("name")+"']").children("td:eq(4)").html());
   $(".button_add").attr("name", "update");
   $(".button_add").attr("id", $(this).attr("name"));
   $(window).scrollTop(0);
});
$(function(){
   $(".buy_date").datepicker({dateFormat: 'yy-mm-dd'});
   $(".make_date").datepicker({dateFormat: 'yy-mm-dd'});
   $(".limit_date").datepicker({dateFormat: 'yy-mm-dd'});
});
});

return {
validate:function(type_action, id, name_title, buy_date, make_date, limit_date)
{
   var r=/\d{4}-\d{2}-\d{2}/;
   if(name_title=="" || !r.test(buy_date) || !r.test(make_date) || !r.test(limit_date))
   {
      $(".title_error").html("Error of entering of data(field name must be <u>not empty</u>, fields date of... must be <u>yyyy-mm-dd</u>)");
   }
   else
   {
      BaseRecord.enter(type_action, id, name_title, buy_date, make_date, limit_date);
   }
},

enter:function(type_action, id, name_title, buy_date, make_date, limit_date)
{
   var ajaxSetting={
      method:"post",
      url:"refrigerator/lead-enter?id="+encodeURIComponent(id)+"&type_action="+encodeURIComponent(type_action)+"&name_title="+encodeURIComponent(name_title)+"&buy_date="+encodeURIComponent(buy_date)+"&make_date="+encodeURIComponent(make_date)+"&limit_date="+encodeURIComponent(limit_date),      
      success:function(data) {
         var data_json=JSON.parse(data);
         if(data_json['result']=="error") {
            $(".title_error").html(data_json['title']);
         }
         if(data_json['result']=="success") {
            location.href="/refrigerator";
         }

      },
    };
   $.ajax(ajaxSetting);
},

};

})();