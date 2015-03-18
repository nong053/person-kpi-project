
	//var kpi_year="2012";
	//var appraisal_period_id="All";
	//var department_id="1";
	
	
	var easyPieChartFn=function(kpi_year){
		
		
		$('.easyPieChart').easyPieChart({
			//easing: 'easeOutBounce',
			size:'50',
			lineWidth:'5',
			//barColor:'green',
			//trackColor:false ,
			scaleColor:false,
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});

	}
	var  getColorBall=function(score){
		
		//alert(score);
		
		var ballScoll = "";
		$.ajax({
			url:"../Model/mGetStatus.php",
			type:"get",
			dataType:"json",
			async:false,
			//data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"emp_id":emp_id},
			success:function(data){
				//console.log(data);
				//get data from model for loop value is between value is coret this argument   
				$.each(data,function(index,indexIntry){
					
					console.log(indexIntry+"="+score);
					
					 if(index==0 && (parseInt(indexIntry[1])<= score  ) &&( parseInt(indexIntry[2])>= score)){
						 
						   ballScoll+="<div id='ball1'  class='ball' style='background-color:#"+indexIntry[3]+"; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+="<div id='ball2'  class='ball' style='background-color:#cccccc; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+="<div id='ball3'  class='ball' style='background-color:#cccccc; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+=parseFloat(score).toFixed(2)+"%";
		                   
					 }else if(index==1 && (parseInt(indexIntry[1])<= score  ) &&( parseInt(indexIntry[2])>= score)){
						 
						   ballScoll+="<div id='ball1' class='ball' style='background-color:#cccccc; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+="<div id='ball2'  class='ball' style='background-color:#"+indexIntry[3]+"; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+="<div id='ball3'  class='ball'style='background-color:#cccccc; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+=parseFloat(score).toFixed(2)+"%";
		                   
					 }else if(index==2 && (parseInt(indexIntry[1])<= score  ) ){
						 
						   ballScoll+="<div id='ball1'  class='ball' style='background-color:#cccccc; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+="<div id='ball2'  class='ball' style='background-color:#cccccc; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+="<div id='ball3'  class='ball' style='background-color:#"+indexIntry[3]+"; width:20px;height:20px;border-radius:100px; float:left;'></div>";
		                   ballScoll+=parseFloat(score).toFixed(2)+"%";
					 }
					 
				});
				
			}

		});
		
		return ballScoll;
	  }

	var gaugeOwner=function(kpi_year,appraisal_period_id,department_id){

		//Guage Owner START
		$.ajax({
			url:"../Model/mGetOwnerKpiResult.php",
			type:"get",
			data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"action":"guageOwner","department_id":department_id},
			dataType:"json",
			success:function(data){
				
				var $ranges="";
				//alert(data[0][0]);
				if(data[0][0]==0){
					 
                   $ranges+="ranges: [";
                        $ranges+="{";
                            $ranges+="from: 0,";
                            $ranges+="to: 100,";
                            $ranges+="color: \"#ffc700\"";
                        $ranges+="}";
                    $ranges+="]";
                   
				}else{
					
				//var score="[["+data[0][0]+"]]";
				//var scoreObj=score=eval("("+score+")");
				
				var intervalsStartArray=data[0][1];
				var intervalsStart=intervalsStartArray.split(",");
				
				var intervalsEndArray=data[0][2];
				var intervalsEnd=intervalsEndArray.split(",");
				
				//alert(intervals);
				var intervalColorsArray=data[0][3];
				intervalColorsArray=intervalColorsArray.split(",");
				
				var intervalColors="'"+intervalColorsArray[0]+"','"+intervalColorsArray[1]+"','"+intervalColorsArray[2]+"'";
					$ranges+=" [";
					$ranges+=" {";
							$ranges+="from: "+intervalsStart[0]+",";
							$ranges+="to: "+intervalsEnd[0]+",";
							$ranges+="color: \"#"+intervalColorsArray[0]+"\"";
						$ranges+=" }, {";
							$ranges+="from: "+intervalsStart[1]+",";
							$ranges+="to: "+intervalsEnd[1]+",";
							$ranges+=" color: \"#"+intervalColorsArray[1]+"\"";
						$ranges+="}, {";
							$ranges+=" from: "+intervalsStart[2]+",";
							$ranges+="to: "+intervalsEnd[2]+",";
							$ranges+="color: \"#"+intervalColorsArray[2]+"\"";
							$ranges+= " }";
						$ranges+= "]";
						
						var objRanges=eval("("+$ranges+")");
				
				//Gauge for check data value end
				}
				//alert($ranges);
				
				
				 $("#gaugeOwner").kendoRadialGauge({
					 		
					  pointer: {
		                  value:data[0][0]
		              },

		              scale: {
		                  minorUnit: 5,
		                  startAngle: -30,
		                  endAngle: 210,
		                  max: 100,
		                  labels: {
		                     // position: labelPosition || "inside"
		                  },
		                  ranges:objRanges
		                 
		              }
		          });
				
				 $("#gauge-value").html("บริษัท "+parseFloat(data[0][0]).toFixed(2)+"%");
				
			}
		});
		
		
		//Guage Owner END
		
		  
		
	}
	var gaugeDep=function(kpi_year,appraisal_period_id,department_id){

		//Guage Owner START
		$.ajax({
			url:"../Model/mGetOwnerKpiResult.php",
			type:"get",
			data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"action":"guageOwner","department_id":department_id},
			dataType:"json",
			success:function(data){
				
				var $ranges="";
				//alert(data[0][0]);
				if(data[0][0]==0){
					 
                   $ranges+="ranges: [";
                        $ranges+="{";
                            $ranges+="from: 0,";
                            $ranges+="to: 100,";
                            $ranges+="color: \"#ffc700\"";
                        $ranges+="}";
                    $ranges+="]";
                   
				}else{
					
				//var score="[["+data[0][0]+"]]";
				//var scoreObj=score=eval("("+score+")");
				
				var intervalsStartArray=data[0][1];
				var intervalsStart=intervalsStartArray.split(",");
				
				var intervalsEndArray=data[0][2];
				var intervalsEnd=intervalsEndArray.split(",");
				
				//alert(intervals);
				var intervalColorsArray=data[0][3];
				intervalColorsArray=intervalColorsArray.split(",");
				
				var intervalColors="'"+intervalColorsArray[0]+"','"+intervalColorsArray[1]+"','"+intervalColorsArray[2]+"'";
					$ranges+=" [";
					$ranges+=" {";
							$ranges+="from: "+intervalsStart[0]+",";
							$ranges+="to: "+intervalsEnd[0]+",";
							$ranges+="color: \"#"+intervalColorsArray[0]+"\"";
						$ranges+=" }, {";
							$ranges+="from: "+intervalsStart[1]+",";
							$ranges+="to: "+intervalsEnd[1]+",";
							$ranges+=" color: \"#"+intervalColorsArray[1]+"\"";
						$ranges+="}, {";
							$ranges+=" from: "+intervalsStart[2]+",";
							$ranges+="to: "+intervalsEnd[2]+",";
							$ranges+="color: \"#"+intervalColorsArray[2]+"\"";
							$ranges+= " }";
						$ranges+= "]";
						
						var objRanges=eval("("+$ranges+")");
				
				//Gauge for check data value end
				}
				//alert($ranges);
				
				
				 $("#gaugeDep").kendoRadialGauge({
					 		
					  pointer: {
		                  value:data[0][0]
		              },

		              scale: {
		                  minorUnit: 5,
		                  startAngle: -30,
		                  endAngle: 210,
		                  max: 100,
		                  labels: {
		                     // position: labelPosition || "inside"
		                  },
		                  ranges:objRanges
		                 
		              }
		          });
				
				 $("#gauge-dep-value").html("แผนก "+parseFloat(data[0][0]).toFixed(2)+"%");
				
			}
		});
		
		
		//Guage Owner END
		
		  
		
	}


	//BARCHART START
var barChart=function(kpi_year,department_id){
	
	 /*bar chart  appraisal period start*/
	$.ajax({
		url:"../Model/mGetOwnerKpiResult.php",
		type:"get",
		dataType:"json",
		data:{"kpi_year":kpi_year,"action":"appraialBarChartOwner","department_id":department_id},
		success:function(data){
			//alert(data);
			// ####### Create Category Bargrpah Start.
			var  $categoriesArray=data[0][2];
			$categoriesArray=$categoriesArray.split(",");
			var $categories="";
			$categories="[";
			for(var i=0; i<$categoriesArray.length; i++){
				if(i==0){
					$categories+="\""+$categoriesArray[i]+"\"";
				}else{
					$categories+=",\""+$categoriesArray[i]+"\"";
				}
			}
			$categories+="]";
			var categoriesObj=eval("("+$categories+")");
			// ######### Create Category Bargrpah End.
			
			// ###### Create Series Bargraph Start
			var seriesArray="";
			seriesArray+="[";
			$.each(data,function(index,indexEntry){
				
					//alert(indexEntry[0]);
					
					if(index==0){
						seriesArray+="{";
						if(indexEntry[0]=="Target"){
							seriesArray+="type: \"line\",";
						}
					}else{
						
						seriesArray+=",{";
						if(indexEntry[0]=="Target"){
							seriesArray+="type: \"line\",";
						}
					}
					
					//seriesArray+="type: \"line\",";
					//alert(indexEntry[1]);
					
					seriesArray+="name: \""+indexEntry[0]+"\",";
					seriesArray+="data: ["+indexEntry[1]+"]";
					seriesArray+="}";
				
			});
			seriesArray+="]";
			//alert(seriesArray);
			var seriesArrayObj=eval("("+seriesArray+")");
			//console.log(seriesArrayObj);
			//###### Create Series Bargraph End
			
			
			/*bar chart power by kendo ui start*/
			
			 $("#barChartOwner").kendoChart({
				 	theme:"Flat",
				 	
				 	//theme:"Bootstrap",
			        title: {
			        	visible: true,
			            text: "ผลการประเมิน"
			        },
			        legend: {
			            position: "right"
			        },
			        seriesDefaults: {
			            type: "column"
			        },
			        series: seriesArrayObj,
			        valueAxis: {
			            labels: {
			                format: "{0}"
			            },
			            line: {
			                visible: false
			            },
			            axisCrossingValue: 0
			        },
			        categoryAxis: {
			            categories: categoriesObj,
			            line: {
			                visible: false
			            },
			            labels: {
			               // padding: {top: 135}
			            }
			        },
			        tooltip: {
			            visible: true,
			            format: "{0}",
			            template: "#= series.name #: #= value #%"
			        }
			    });
			 
			/*bar chart power by kendo ui end*/

		}
	});
	
	
	 /*bar chart end*/

};


//BARCHART END

//################# Easy Pie Chart Start #################
var easyPieChartMainFn = function(kpi_year,appraisal_period_id){
	$.ajax({
		url:"../Model/mGetOwnerKpiResult.php",
		type:"get",
		dataType:"json",
		data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"action":"scoreDepartmentOwner"},
		success:function(data){
			//alert(data);
			
			/*
		
			 
	.bgColorGreen{
		background:#5CB85C;
	}
	.bgColorYellow{
		background:yellow;
	}
	.bgColorRed{
		background:#D9534F;
	}
	.bgColorGray{
		background:#cccccc;
	}
	.bgColorBlue{
		background:#5BC0DE;
	}
	.bgColorOrange{
		background:#F0AD4E;
	}
		
			 */
			var colorArray=Array();
			/*
			#1c9ec4
			#ff63a5
			#10c4b2
			#ff7663
			#ffb74f
			#a2df53
			*/
			
			colorArray[0]="#10c4b2";
			colorArray[1]="#ff7663";
			colorArray[2]="#ffb74f";
			colorArray[3]="#a2df53";
			colorArray[4]="#1c9ec4";
			colorArray[5]="#ff63a5";
			
			/*
			colorArray[0]="#5CB85C";
			colorArray[1]="#5BC0DE";
			colorArray[2]="#F0AD4E";
			colorArray[3]="#D9534F";
			colorArray[4]="#cccccc";
			colorArray[5]="yellow";
			*/
			var easyChartAreaLayout="";
			
			$.each(data,function(index,indexEntry){
				//KpiPerspective
			easyChartAreaLayout+="<div class='KpiPerspective  col-xs-6 col-sm-6 col-md-6' id='KpiPerspective-"+indexEntry[0]+"' style='height:78px; cursor:pointer; background:"+colorArray[index]+"'>";
				easyChartAreaLayout+="<div class='boxStatus'>";
				easyChartAreaLayout+="<div class='boxGraphTop ' >";
				easyChartAreaLayout+="<div id='donutStatus1 '>";
								
				easyChartAreaLayout+="<span class='easyPieChart' data-percent="+indexEntry[2]+">";
				easyChartAreaLayout+="<span class='percent'></span>";
				easyChartAreaLayout+="</span>";
								
				easyChartAreaLayout+="</div>";
				easyChartAreaLayout+="</div>";
				easyChartAreaLayout+="<div class='boxButtonTop'>";
				easyChartAreaLayout+=indexEntry[1];
				easyChartAreaLayout+="</div>";
				easyChartAreaLayout+="</div>";
				easyChartAreaLayout+="<br style='clear:both'>";
			easyChartAreaLayout+="</div>";
			
				
			//alert(indexEntry[0]);
				//easyChartAreaLayout+="<div class='col-xs-6 col-md-6' style='background:"+colorArray[index]+"'>";
					
				//easyChartAreaLayout+="</div>";
				
			});
			
			$("#pieByDepartment").html(easyChartAreaLayout);
			easyPieChartFn(kpi_year);
			//#################  Table Kpi Result End   #####################

			//click perspective for open view start
			/* start call KpiPerspective */
			$(".KpiPerspective").off("click");
			$(".KpiPerspective").on("click",function(){
				//alert("hello click perspective");
				var department_id=this.id.split("-");
				department_id=department_id[1];
				var department_name=$(this).children().children().next().text();
				
				//### Embed Page and  Embed Department Start ###
				$(".pageEmb").remove();
				$(".department_emp").remove();
				$("body").append("<input type=\"hidden\" name=\"pageDepartment\" id=\"pageDepartment\" class=\"pageEmb\" value=\"pageDepartment\">");
				$("body").append("<input type=\"hidden\" name=\"paramDepartmentEmb\" id=\"paramDepartmentEmb\" class=\"department_emp\" value="+department_id+">");
				$("body").append("<input type=\"hidden\" name=\"department_name_emp\" id=\"department_name_emp\" class=\"department_emp\" value="+department_name+">");
				//### Embed Page Embed Department End ###
				
				$.ajax({
					url:"../View/vKpiDashboard.php",
					type:"get",
					dataType:"html",
					async:false,
					data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"department_id":department_id,"department_name":department_name},
					success:function(data){
						$("#mainContent").html(data);
						callProgramControl("cKpiDashboard.js");
						kpiDasboardMainFn(kpi_year,appraisal_period_id,department_id,department_name);
					}
				});
				
				//alert(department_id);
				
			});
			/* end call KpiPerspective */
			
			
		}
	});
	
	
}




//################# Easy Pie Chart End ###################
//#################  Pie Chart Department Result Start ###
var pieChartDepResult=function(kpi_year,appraisal_period_id){
	$.ajax({
		//url:"../Model/mGetPersonKpiResult.php",
		url:"../Model/mGetOwnerKpiResult.php",
		type:"get",
		dataType:"json",
		data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"action":"pieChartByDepartment"},
		success:function(data){
			
			var textJson="[";
        	$.each(data,function(index,indexEntry){
        		//[[\"Heavy Industry\",12],[\"Retail\",9],[\"Light Industry\",14],[\"Out of home\",16],[\"Commuting\", 7],[\"Orientation\", 9]]";
        		if(index==0){
        			textJson+="{";
        		}else{
        			textJson+=",{";
        		}
        		//alert(indexEntry[0]);
        		textJson+="category:\""+indexEntry[0]+"\",";
    			textJson+="value:"+parseFloat(indexEntry[1]).toFixed(2)+"";
        		textJson+="}";
        	});
        	textJson+="]";
        	//alert(textJson);
        	var objJson=eval("("+textJson+")");
        	//alert(textJson);
			//console.log(objJson);
			
			//kendo ui pie start
			$("#pieChartByDepartment").kendoChart({
				theme:"Flat",
                title: {
                    position: "bottom",
                    //text: "ผลการประเมินแยกตามแยกตามแตะะแผนก"
                },
                legend: {
                    visible: true,
                    position:"bottom"
                },
                chartArea: {
                    background: ""
                },
                seriesDefaults: {
                    labels: {
                        visible: true,
                        background: "transparent",
                        template: "#= category #: \n #= value#%"
                    }
                },
                series: [{
                    type: "donut",
                    startAngle: 150,
                    data: objJson,
                    labels: {
                        visible: false,
                        background: "transparent",
                        position: "outsideEnd",
                        template: "#= category #: \n #= value#%"
                    }
                }],
                tooltip: {
                    visible: true,
                    /*format: "{0}%"*/
                    /*template: "#= category # (#= series.name #): #= value #%"*/
                    template: "#= category # - #= kendo.format('{0:P}', percentage) #"
                }
            });
			//kendo ui pie end
		}
	});		
}
//pieChartDepResult();
//#################  Pie Chart Department Result End   ###################
//########  Pie Chart Kpi Result Start ###
var piChartkpiResult = function(kpi_year,appraisal_period_id,department_id){
	$.ajax({
		//url:"../Model/mGetPersonKpiResult.php",
		url:"../Model/mGetOwnerKpiResult.php",
		type:"get",
		dataType:"json",
		data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"action":"pieChartKpiResult","department_id":department_id},
		success:function(data){
			var textJson="[";
	    	$.each(data,function(index,indexEntry){
	    		//[[\"Heavy Industry\",12],[\"Retail\",9],[\"Light Industry\",14],[\"Out of home\",16],[\"Commuting\", 7],[\"Orientation\", 9]]";
	    		if(index==0){
	    			textJson+="{";
	    		}else{
	    			textJson+=",{";
	    		}
	    		textJson+="category:\""+indexEntry[0]+"\",";
				textJson+="value:"+parseFloat(indexEntry[1]).toFixed(2)+"";
	    		textJson+="}";
	    	});
	    	textJson+="]";
	    	var objJson=eval("("+textJson+")");
			console.log(objJson);
			$("#pieChartKpiResult").kendoChart({
				theme:"Flat",
	            title: {
	                position: "bottom",
	                //text: "ผลการประเมินแยกตาม KPI"
	            },
	            legend: {
	                visible: false
	            },
	            chartArea: {
	                background: ""
	            },
	            seriesDefaults: {
	                labels: {
	                    visible: false,
	                    background: "transparent",
	                    template: "#= category #: \n #= value#%"
	                }
	            },
	            series: [{
	                type: "pie",
	                startAngle: 150,
	                data: objJson,
	               
	            }],
	            tooltip: {
	                visible: true,
	                template: "#= category # - #= kendo.format('{0:P}', percentage) #"
	                /*format: "{0}%"*/
	            }
	        });
			//kendo ui pie end
		}
	});
}
//piChartkpiResult();
//#################  Pie Chart Kpi Result End   ###################
//#################  Table Kpi Result Start   ###################
var sparklineBulet=function(graphName){
	$(graphName).sparkline("html", {
	    type: 'bullet',
	    });
	}
//sparklineBulet();
var sparklineLine=function(graphName){
	$(graphName).sparkline("html", {
	    type: 'line',
	    width: '80',
	    height: '20'});
}
var TableKpiResult = function(kpi_year,appraisal_period_id,department_id){
	
	$.ajax({
		url:"../Model/mGetOwnerKpiResult.php",
		type:"get",
		dataType:"json",
		async:false,
		data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"action":"tableKpiResult","department_id":department_id},
		success:function(data){
			//alert(data);
			var textJson="";
			textJson+="[";
			$.each(data,function(index,EntryIndex){
				$.ajax({
					url:"../Model/mDashboardDivision.php",
					type:"get",
					dataType:"json",
					async:false,
					data:{"kpi_year":kpi_year,"appraisal_period_id":appraisal_period_id,"kpi_id":EntryIndex[0],"action":"score_spraph"},
					success:function(data){
						var score_spraph=data[0][0];
						//alert(""+score_spraph+"");
						//return "0,80,80";
							if(index==0){
								textJson+="{";
							}else{
								textJson+=",{";
							}
				/*kpi_id,kpi_name,kpi_target,kpi_actual,kpi_performance*/
				
					textJson+="\"Field1\":\"<div class='textR'>"+EntryIndex[0]+"</div>\",";
					textJson+="\"Field2\":\"<div class=''>"+EntryIndex[1]+"</div>\",";
					textJson+="\"Field3\":\"<div class='textR'>"+parseFloat(EntryIndex[2]).toFixed(0)+"</div>\",";
					textJson+="\"Field4\":\"<div class='textR'>"+parseFloat(EntryIndex[3]).toFixed(0)+"</div>\",";
					textJson+="\"Field5\":\"<div class='lineSparkline'>"+score_spraph+"</div>\",";
					textJson+="\"Field6\":\"<div class='sparklineBullet'>"+EntryIndex[4]+",100,100,80</div>\",";
					textJson+="\"Field7\":\"<div class='textR'><center>"+getColorBall(EntryIndex[4])+"</center></div>\",";
				
				textJson+="}";
		
					}
				});
				
			});
			textJson+="]";
			//alert(textJson);
			var objJson2=eval("("+textJson+")");
			
			var htmlGridKpiResult="";
			// table grid start
			htmlGridKpiResult+="<table id=\"tableKpiResult\">";
			htmlGridKpiResult+="<colgroup>";
			
					htmlGridKpiResult+="<col style=\"width:5%\" />";
					htmlGridKpiResult+="<col style=\"width:40%\"/>";
					htmlGridKpiResult+="<col style=\"width:7%\"/>";
					htmlGridKpiResult+="<col style=\"width:7%\"/>";
					htmlGridKpiResult+="<col style=\"width:7%\"/>";
					htmlGridKpiResult+="<col style=\"width:10%\"/>";
					htmlGridKpiResult+="<col style=\"width:15%\"/>";
					/*htmlGridKpiResult+="<col />";*/
					
					
			htmlGridKpiResult+="</colgroup>";
				htmlGridKpiResult+="<thead>";
					htmlGridKpiResult+="<tr>";
						htmlGridKpiResult+="<th data-field=\"Field1\"><b>Code</b></th>";
						htmlGridKpiResult+="<th data-field=\"Field2\"><b>KPI Name</b></th>";
						htmlGridKpiResult+="<th data-field=\"Field3\"><b>Target</b></th>";
						htmlGridKpiResult+="<th data-field=\"Field4\"><b>Actual</b></th>";
						htmlGridKpiResult+="<th data-field=\"Field5\"><b>Graph</b></th>";
						htmlGridKpiResult+="<th data-field=\"Field6\"><b>Target</b></th>";
						htmlGridKpiResult+="<th data-field=\"Field7\"><b>Performance</b></th>";
					htmlGridKpiResult+="</tr>";
				htmlGridKpiResult+="</thead>";
			htmlGridKpiResult+="<tbody>";
				htmlGridKpiResult+="<tr>";
					htmlGridKpiResult+="<td></td>";
						htmlGridKpiResult+="<td></td>";
						htmlGridKpiResult+="<td></td>";
						htmlGridKpiResult+="<td></td>";
						htmlGridKpiResult+="<td></td>";
						htmlGridKpiResult+="<td></td>";
						htmlGridKpiResult+="<td></td>";
						htmlGridKpiResult+="</tr> ";
				htmlGridKpiResult+="</tbody>";
			htmlGridKpiResult+="</table>";
            // table grid end 
			$("#tableGridKpieResultArea").html(htmlGridKpiResult);
			
			$("#tableKpiResult").kendoGrid({
				 dataSource: {
			          data:objJson2 
			          },
		        sortable: true
		   	});
			
			$(".k-grid td").css({"padding":"0px;"});
			sparklineBulet(".sparklineBullet");
			sparklineLine(".lineSparkline");
		}
	});

}	
//TableKpiResult();


//dropdown List AppralisalPeriod start
var fnDropdownListAppralisal=function(year,appraisal_period_id){
	//alert(year);
	$.ajax({
		url:"../Model/mAppralisalPeriodList.php",
		type:"post",
		dataType:"json",
		async:false,
		data:{"year":year,"paramSelectAll":"selectAll"},
		success:function(data){
			//alert(data);
			var htmlDropDrowList="";
			htmlDropDrowList+="<select id=\"appraisal_period_id\" name=\"appraisal_period_id\" class=\"form-control input-sm\" style=\"width:80px;\">";
				$.each(data,function(index,indexEntry){
					if(appraisal_period_id==indexEntry[0]){
						htmlDropDrowList+="<option value="+indexEntry[0]+" selected>"+indexEntry[1]+"</option>";	
					}else{
						htmlDropDrowList+="<option value="+indexEntry[0]+">"+indexEntry[1]+"</option>";
					}
					
				});
			htmlDropDrowList+="</select>";
			//alert(htmlDropDrowList);
			$("#appraisalPeriodAea").html(htmlDropDrowList);
			//persDropDrowList
		}
	});
}	

//#################  Create Parameter End #####################

//#################  Create Parameter Year Start   ############
var paramYear=function(kpi_year){
	//alert(kpi_year);

		$.ajax({
			url:"../Model/mAppraisalYearList.php",
			type:"post",
			dataType:"json",
			async:false,
			success:function(data){
				var htmlDropDrowList="";
				htmlDropDrowList+="<select id=\"appraisal_year\" name=\"appraisal_year\" class=\"form-control input-sm\" style=\"width:80px;\">";
					$.each(data,function(index,indexEntry){
						if(kpi_year!=undefined){
							if(kpi_year==indexEntry[0]){
								htmlDropDrowList+="<option value="+indexEntry[0]+" selected>"+indexEntry[0]+"</option>";	
							}else{
								htmlDropDrowList+="<option value="+indexEntry[0]+">"+indexEntry[0]+"</option>";
							}
							
						}else{
							//alert(indexEntry[1]);
							if(indexEntry[1]==1){
								htmlDropDrowList+="<option value="+indexEntry[0]+" selected>"+indexEntry[0]+"</option>";	
							}else{
								htmlDropDrowList+="<option value="+indexEntry[0]+">"+indexEntry[0]+"</option>";
							}
							
						}
							
									
							
							
						
					});
				htmlDropDrowList+="</select>";
				$("#appraisalYearArea").html(htmlDropDrowList);
				$("#appraisal_year").change(function(){
					
					fnDropdownListAppralisal($(this).val());
				});
			}
		});
		

}

paramYear($("#paramYearEmb").val());
fnDropdownListAppralisal($("#appraisal_year").val());


//#################  Create Parameter Dep Default Start ############

fnDropdownListDep("","selectAll");

//#################  Create Parameter Dep Default End   ############

//#################  Create Parameter Year End   ############



//#################  submit button action start #####################
/*
$("#appraisalPeriodSubmit").off("click");
$("#appraisalPeriodSubmit").on("click",function(){
	
	
	$(".paramEmb").remove();
	$("body").append("<input type='hidden' class='paramEmb' name='paramYearEmb' id='paramYearEmb' value='"+$("#appraisal_year").val()+"'>");
	$("body").append("<input type='hidden' class='paramEmb' name='paramAppraisalEmb' id='paramAppraisalEmb' value='"+$("#appraisal_period_id").val()+"'>");
	
	if($(".pageEmb").val()=="pageDepartment"){
		
		//### Call Program department Page Start ###
		
		kpiDasboardMainFn($("#paramYearEmb").val(),$("#paramAppraisalEmb").val(),$("#department_id_emp").val(),$("#department_name_emp").val());
		
		//### Call Program department Page Start ###
	}else{
		//alert("page not Department");
		gaugeOwner($("#paramYearEmb").val(),$("#paramAppraisalEmb").val());
		barChart($("#paramYearEmb").val());
		easyPieChartMainFn($("#paramYearEmb").val(),$("#paramAppraisalEmb").val());
		pieChartDepResult($("#paramYearEmb").val(),$("#paramAppraisalEmb").val());
		piChartkpiResult($("#paramYearEmb").val(),$("#paramAppraisalEmb").val());
		TableKpiResult($("#paramYearEmb").val(),$("#paramAppraisalEmb").val());
	}
	

});
$("#appraisalPeriodSubmit").click();
*/
//#################  submit button action end   #####################


//################ button top right start  in panel ###########
$(".glyphicon-minus-top").click(function(){
	
	$(".panel-body-top").slideUp();
	
});
$(".glyphicon-resize-full-top").click(function(){
	
	$(".panel-body-top").slideDown();
	
});
$(".glyphicon-remove-top").click(function(){
	
	$(".panel-top").hide();
	
});
//################ button top right start  in panel ###########
//################ button bottom right start  in panel ###########
$(".glyphicon-minus-bottom").click(function(){
	
	$(".panel-body-bottom").slideUp();
	
});
$(".glyphicon-resize-full-bottom").click(function(){
	
	$(".panel-body-bottom").slideDown();
	
});
$(".glyphicon-remove-bottom").click(function(){
	
	$(".panel-bottom").hide();
	
});
//################ button bottom right start  in panel ###########



//#################  submit button action start #####################

$("#appraisalPeriodSubmit").off("click");
$("#appraisalPeriodSubmit").on("click",function(){
				
				//alert($(".RoleEmb").val());
				$(".paramEmb").remove();
				$(".department_emp").remove();
				
				$("body").append("<input type='hidden' class='paramEmb' name='paramYearEmb' id='paramYearEmb' value='"+$("#appraisal_year").val()+"'>");
				$("body").append("<input type='hidden' class='paramEmb' name='paramAppraisalEmb' id='paramAppraisalEmb' value='"+$("#appraisal_period_id").val()+"'>");
				$("body").append("<input type='hidden' class='paramEmb' name='paramDepartmentEmb' id='paramDepartmentEmb' value='"+$("#department_id").val()+"'>");
				$("body").append("<input type='hidden' class='paramEmb' name='paramDepartmentNameEmb' id='paramDepartmentNameEmb' value='"+$("#department_id option:selected").text()+"'>");
				
				if($(".pageEmb").val()=="pageDepartment"){
					if($(".RoleEmb").val()=="roleEmp"){
						
						//### Call kpiDasboardMainFn for emp role Start ###
						$.ajax({
							url:"../View/vKpiDashboard.php",
							type:"get",
							dataType:"html",
							async:false,
							data:{"kpi_year":$("#paramYearEmb").val(),"appraisal_period_id":$("#paramAppraisalEmb").val(),
								"department_id":$("#departmentIdEmp").val(),"department_name":$("#departmentNameEmp").val()
								},
							success:function(data){
								$("#mainContent").html(data);
								callProgramControl("cKpiDashboard.js");
								
								kpiDasboardMainFn($("#paramYearEmb").val(),$("#paramAppraisalEmb").val(),$("#departmentIdEmp").val(),$("#departmentNameEmp").val(),$("#emp_id").val());
								//### drawdown grid for show detail within ###
								//$(".k-icon").click();
							}
						});
						//### Call kpiDasboardMainFn for emp role End ###
						
					}else{
					
					//### Call Program department Page Start ###
						kpiDasboardMainFn($("#paramYearEmb").val(),$("#paramAppraisalEmb").val(),$("#department_id_emp").val(),$("#department_name_emp").val());
					//### Call Program department Page Start ###
					}
					
					
				}else{//else2
					//alert('hello 2');
					//kpiOwnerFn();
					// call function index page
					if($("#paramDepartmentEmb").val()=="All"){
						$("#areaPieByDepartment").empty();
						
						$("#areaPieByDepartment").html("<div id='pieByDepartment'></div>");
						easyPieChartMainFn($("#paramYearEmb").val(),$("#paramAppraisalEmb").val());
						$("#pieChartByDepartment").show();
						$("#pieChartKpiResult").hide();
						$("#titleKpiAndDep").html("ผลการประเมินตามแผนก");
						$("#titleDepTop").html("ผลการประเมินแต่ละแผนก");
						
						pieChartDepResult($("#paramYearEmb").val(),$("#paramAppraisalEmb").val());
					}else{
						$("#areaPieByDepartment").empty();
						var htmlGaugeArea="";
						htmlGaugeArea+="<div id=\"gauge-container\">";
						htmlGaugeArea+="<div class=\"gaugeDep\" id=\"gaugeDep\"></div>";
						htmlGaugeArea+="<div id=\"gauge-dep-value\"></div>";
						htmlGaugeArea+="</div>";
						
						$("#areaPieByDepartment").html(htmlGaugeArea);
						
						gaugeDep($("#paramYearEmb").val(),$("#paramAppraisalEmb").val(),$("#paramDepartmentEmb").val());
						//Click Department to Show Detail into Start.
						actionGaugeDep();
						// Click Department to Show Detail into End.
						
						$("#pieChartByDepartment").hide();
						$("#pieChartKpiResult").show();
						$("#titleKpiAndDep").html("ผลการประเมินตามKPIs");
						//alert($("#paramDepartmentNameEmb").val());
						$("#titleDepTop").html("ผลการประเมิน"+$("#paramDepartmentNameEmb").val());
						piChartkpiResult($("#paramYearEmb").val(),$("#paramAppraisalEmb").val(),$("#paramDepartmentEmb").val());
					}
					gaugeOwner($("#paramYearEmb").val(),$("#paramAppraisalEmb").val(),"All");
					barChart($("#paramYearEmb").val(),$("#paramDepartmentEmb").val());
					TableKpiResult($("#paramYearEmb").val(),$("#paramAppraisalEmb").val(),$("#paramDepartmentEmb").val());
					
				
			
		}
				
				
				

});
//$("#appraisalPeriodSubmit").click();

//#################  submit button action end   #####################


