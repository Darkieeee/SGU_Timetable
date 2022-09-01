function drawTimeTable() {
    /** 
     *  To draw time table view
     */
    
    let table = $("#timetable");
    
    //Add Header
    let tableHeader = "<thead>"
                    + "<tr>"
                        + "<th></th>"
                        + "<th>Thứ hai</th>"
                        + "<th>Thứ ba</th>"
                        + "<th>Thứ tư</th>"
                        + "<th>Thứ năm</th>"
                        + "<th>Thứ sáu</th>"
                        + "<th>Thứ bảy</th>"
                        + "<th>Chủ nhật</th>"
                        + "<th></th>"
                    + "</tr>"
                    + "</thead>";
    
    const daysOfAWeek = 7;
    const totalPeriod = 13;
    const periodBeginEnd = ["7:00-7:50",
                            "7:50-8:40",
                            "9:00-9:50",
                            "9:50-10:40",
                            "10:40-11:30",
                            "13:00-13:50",
                            "13:50-14:40",
                            "15:00-15:50",
                            "15:50-16:40",
                            "16:40-17:30",
                            "17:40-18:30",
                            "18:30-19:20",
                            "19:20-20:10"];
    
    //Add Body
    let tableBody = "<tbody>";
    
    for(let period = 1; period <= totalPeriod; period++) {
        tableBody += `<tr>
                        <td>Tiết ${period}<br/> (${periodBeginEnd[period - 1]})</td>`;
        
        for(let day = 0; day < daysOfAWeek; day++) {
            let cell_id = period + "_" + day;
            tableBody += `<td id='${cell_id}'></td>`;
        }
        
        tableBody += ` <td>Tiết ${period}<br/> (${periodBeginEnd[period - 1]})</td>
                      </tr>`;
        
        if(period === 5 || period === 10) {
            var emptyTableHeader = 2; //2 cột hiển thị Tiết;
            var restTime = (period === 5) ? "Nghỉ trưa" : "Nghỉ chiều";
            tableBody += `<tr>
                            <td colspan="${daysOfAWeek + emptyTableHeader}" style="background: transparent; color: black; font-size: 11.5pt">${restTime}</td>
                          </tr>`;
        }
    }
    tableBody += "</tbody>";
    
    //Add footer
    let tableFooter = "<tfoot>"
                    + "<tr>"
                        + "<td></td>"
                        + "<td>Thứ hai</td>"
                        + "<td>Thứ ba</td>"
                        + "<td>Thứ tư</td>"
                        + "<td>Thứ năm</td>"
                        + "<td>Thứ sáu</td>"
                        + "<td>Thứ bảy</td>"
                        + "<td>Chủ nhật</td>"
                        + "<td></td>"
                    + "</tr>"
                    + "</tfoot>";
    
    table.html(tableHeader + tableBody + tableFooter);
}

function saveTimeTableAsImage() {
    html2canvas(document.getElementById("timetable"), {
        allowTaint: true,
        useCORS: true
    }). then(function(canvas){
        var mssv = $("#mssv").val();
        var anchorTag = document.createElement("a");
        document.body.appendChild(anchorTag);
        anchorTag.href = canvas.toDataURL();
        anchorTag.target = "_blank";
        anchorTag.download = `tkb_${mssv}_tuan${curWeek}.png`;
        anchorTag.click();
        anchorTag.remove();
    });
}

function hienthiTKB(dsmh, tuan = 1) {
    for(let i = 0; i < dsmh.length; i++) {
        let tiethoc = dsmh[i].tiethoc;
        for(let j = 0; j < tiethoc.length; j++) {
            if(tiethoc[j].ngayhoc[tuan - 1] !== undefined && tiethoc[j].ngayhoc[tuan - 1] !== "-")
            {
                let tietbd = tiethoc[j].tietbd;
                let buoibd = tiethoc[j].thu;
                let sotiet = tiethoc[j].sotiet;
                
                let cotbd = $(`#${tietbd + "_" + buoibd}`);
                cotbd.attr("rowspan", sotiet);
                cotbd.addClass("course");
                cotbd.html(`<span class='course-name'>${dsmh[i].tenmh}</span>
                            <div class='course-info'>
                                <label>Phòng học: </label>
                                <span class='course-room'>${tiethoc[j].phong}</span>
                                <a class="link">[Xem cơ sở và dãy học]</a>
                            </div>`);
                
                for(let k = tietbd + 1; k < tietbd + sotiet; k++) {
                    let cell = $(`#${k + "_" + buoibd}`);
                    if(cell !== null) {
                        cell.remove();
                    }
                }
            }
        }
    }
}

function displayWeekInfo() {
    $("#weekInfo").text("Tuần " + curWeek);
}

function prevWeek() {
    curWeek--;
    if(curWeek < 1) {
        curWeek = 1;
    }
    
    displayWeekInfo();
    
    drawTimeTable(); //repaint
    hienthiTKB(dsmh, curWeek);
}

function nextWeek() {
    curWeek++;
    if(curWeek > sotuanhoc) {
        curWeek = sotuanhoc;
    }
    
    displayWeekInfo();
    
    drawTimeTable(); //repaint;
    hienthiTKB(dsmh, curWeek);
}

let dsmh = [];
let curWeek = -1;
let sotuanhoc = 0;

$(document).ready(function(){
    $.ajax({
        url: "api/scheduleData.php",
        method: "GET",
        dataType: "json",
        data: {mssv: $("#mssv").val()},
        beforeSend: function() {
            $("body").css("overflow", "hidden");
            $(".loading-modal").show();
            drawTimeTable();
        },
        success: function(data) {
            if(data.status === "success") {
                $("#student-code").text($("#mssv").val());
                $("#student-name").text(data.tensv);
                $("#student-birth").text(data.ngaysinh);
                $("#student-class").text(data.lop);
                
                let hocky_namhoc = data.hocky_namhoc;
                let namhoc = hocky_namhoc.substr(0, hocky_namhoc.length - 1);
                let hocky = hocky_namhoc[hocky_namhoc.length - 1];
                
                curWeek = 1;
                
                if(hocky === 3) {
                    sotuanhoc = 5;
                }
                else {
                    sotuanhoc = 15;
                
                }
                
                $("#semester-title").text(`Học kỳ ${hocky} - Năm học ${namhoc}-${parseInt(namhoc) + 1}`);
                $("#timetable").before(`<ul style="list-style: none; padding: 0px; width: 300px; text-align:center; margin-top: 0">
                                            <li onclick="prevWeek()" style="display: inline-block;"><i class="fa fa-angle-left"></i></li>
                                            <li style="display: inline-block; width: 32%;"><span id="weekInfo" style="font-weight: bold"></span></li>
                                            <li onclick="nextWeek()" style="display: inline-block"><i class="fa fa-angle-right"></i></li>
                                        </ul>
                                        <style>
                                            li * {
                                               font-size: 13pt;
                                            }
                                        </style`);
                
                dsmh = data.dsmh;
                hienthiTKB(data.dsmh);
                displayWeekInfo();
            }
        },
        complete: function() {
            $("body").css("overflow", "auto");
            $(".loading-modal").hide();
        },
        timeout: 15000 //giới hạn 15 giây để load dữ liệu về
    });
});



