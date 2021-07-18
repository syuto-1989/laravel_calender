$(".updateBtn").click(function () {
    var updateId = $(this).val();
    var updateDatekey = $('input[name="update_date_key"]').val();
    var time = $('.time_' + updateId).text();
    var updateHour = time.substring( 0, 2 );
    var updateMinuite = time.substring( 3, 5 );
    var updateSchedule = $('.schedule_' + updateId).text();
    if(updateHour.substring(0,1) == '0'){
       updateHour = updateHour.substring(1,2)
    }
    if(updateMinuite.substring(0,1) == '0'){
       updateMinuite = updateMinuite.substring(1,2)
    }
    console.log(updateHour);
    console.log(updateMinuite);

    var hourSelect = [];
    var minuiteSelect = [];
    var selected = '';
    for (var i=1; i<=24; i++) {
     if(updateHour == i){
          selected = 'selected';
      } else {
          selected = '';
      }
      hourSelect.push('<option value="' + i + '" ' + selected + '>' + i + '</option>');
    }

    for (var i=0; i<=59; i++) {
        if(updateMinuite == i){
          selected = 'selected';
        } else {
          selected = '';
        }

      minuiteSelect.push('<option value="' + i + '" ' + selected + '>' + i + '</option>');

    }
    //console.log(hourSelect);
    //console.log(minuiteSelect);
    var updateHtml = '<div class="card-body"><div class="timeWrap"><div class="timeBox"><select id="schedule_hours" name="schedule_hours" class="form-control"><option value="選択してください" >選択してください</option>' + hourSelect + '</select><span>時</span></div><div class="timeBox"><select id="schedule_minutes" name="schedule_minutes" class="form-control"><option value="選択してください" >選択してください</option>' + minuiteSelect + '</select><span>分</span></div><div class="scheduleText"><span>予定</span><input id="schedule_text" class="form-control" type="text" name="schedule_text" value="' + updateSchedule + '" /></div></div></div><div class="editBlock"><div class="update btn"><button name="id" type="submit" class="updateBtn" value="' + updateId + '">更新</button> </div><div class="delete btn"><a class="delete" href="/extra_holiday_setting/edit/' + updateDatekey + '">キャンセル</a></div></div>';

   $('.box_' + updateId).html(updateHtml);

});

$(document).on("click", ".updateBtnTop", function(){
    var updateId = $(this).val();
    var updateDatekey = $('input[name="update_date_key"]').val();
    var time = $('.time_' + updateId).text();
    var updateHour = time.substring( 0, 2 );
    var updateMinuite = time.substring( 3, 5 );
    var updateSchedule = $('.schedule_' + updateId).text();
    if(updateHour.substring(0,1) == '0'){
       updateHour = updateHour.substring(1,2)
    }
    if(updateMinuite.substring(0,1) == '0'){
       updateMinuite = updateMinuite.substring(1,2)
    }
    console.log(updateHour);
    console.log(updateMinuite);

    var hourSelect = [];
    var minuiteSelect = [];
    var selected = '';
    for (var i=1; i<=24; i++) {
     if(updateHour == i){
          selected = 'selected';
      } else {
          selected = '';
      }
      hourSelect.push('<option value="' + i + '" ' + selected + '>' + i + '</option>');
    }

    for (var i=0; i<=59; i++) {
        if(updateMinuite == i){
          selected = 'selected';
        } else {
          selected = '';
        }

      minuiteSelect.push('<option value="' + i + '" ' + selected + '>' + i + '</option>');

    }
    //console.log(hourSelect);
    //console.log(minuiteSelect);
    var updateHtml = '<div class="card-body"><div class="timeWrap"><div class="timeBox"><select id="schedule_hours" name="update_schedule_hours" class="form-control"><option value="選択してください" >選択してください</option>' + hourSelect + '</select><span>時</span></div><div class="timeBox"><select id="schedule_minutes" name="update_schedule_minutes" class="form-control"><option value="選択してください" >選択してください</option>' + minuiteSelect + '</select><span>分</span></div><div class="scheduleText"><span>予定</span><input id="schedule_text" class="form-control" type="text" name="update_schedule_text" value="' + updateSchedule + '" /></div></div></div><div class="editBlock"><div class="update btn"><button name="id" type="submit" class="ajaxUpdate" value="' + updateId + '">更新</button> </div><div class="cancel btn"><button class="ajaxCancel">キャンセル</button></div></div>';

   $('.box_' + updateId).html(updateHtml);

});
