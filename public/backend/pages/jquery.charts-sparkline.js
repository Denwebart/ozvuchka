/**
* Theme: Adminox Admin Template
* Author: Coderthemes
* Component: Sparkline Chart
* 
*/
$(document).ready(function(){var i=function(){$("#sparkline1").sparkline([0,23,43,35,44,45,56,37,40],{type:"line",width:$("#sparkline1").width(),height:"165",chartRangeMax:50,lineColor:"#32c861",fillColor:"rgba(50, 200, 97, 0.3)",highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:2}),$("#sparkline1").sparkline([25,23,26,24,25,32,30,24,19],{type:"line",width:$("#sparkline1").width(),height:"165",chartRangeMax:40,lineColor:"#e52b4c",fillColor:"rgba(229, 43, 76, 0.3)",composite:!0,highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:2}),$("#sparkline2").sparkline([3,6,7,8,6,4,7,10,12,7,4,9,12,13,11,12],{type:"bar",height:"165",barWidth:"10",barSpacing:"3",barColor:"#5553ce"}),$("#sparkline3").sparkline([20,40,30,10],{type:"pie",width:"165",height:"165",sliceColors:["#60befc","#6248ff","#e3b0db","#dbdbdb"]}),$("#sparkline4").sparkline([0,23,43,35,44,45,56,37,40],{type:"line",width:$("#sparkline1").width(),height:"165",chartRangeMax:50,lineColor:"#78c350",fillColor:"transparent",lineWidth:2,highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)",maxSpotColor:!1,minSpotColor:!1,spotColor:!1}),$("#sparkline4").sparkline([25,23,26,24,25,32,30,24,19],{type:"line",width:$("#sparkline1").width(),height:"165",chartRangeMax:40,lineColor:"#348cd4",fillColor:"transparent",composite:!0,lineWidth:2,maxSpotColor:!1,minSpotColor:!1,spotColor:!1,highlightLineColor:"rgba(0,0,0,1)",highlightSpotColor:"rgba(0,0,0,1)"}),$("#sparkline6").sparkline([3,6,7,8,6,4,7,10,12,7,4,9,12,13,11,12],{type:"line",width:$("#sparkline1").width(),height:"165",lineColor:"#ffa91c",lineWidth:2,fillColor:"rgba(255,169,28,0.3)",highlightLineColor:"rgba(0,0,0,.1)",highlightSpotColor:"rgba(0,0,0,.2)"}),$("#sparkline6").sparkline([3,6,7,8,6,4,7,10,12,7,4,9,12,13,11,12],{type:"bar",height:"165",barWidth:"10",barSpacing:"5",composite:!0,barColor:"#4489e4"}),$("#sparkline7").sparkline([4,6,7,7,4,3,2,1,4,4,5,6,3,4,5,8,7,6,9,3,2,4,1,5,6,4,3,7],{type:"discrete",width:"280",height:"165",lineColor:"#36404c"}),$("#sparkline8").sparkline([10,12,12,9,7],{type:"bullet",width:"280",height:"80",targetColor:"#64c5b1",performanceColor:"#5553ce"}),$("#sparkline9").sparkline([4,27,34,52,54,59,61,68,78,82,85,87,91,93,100],{type:"box",width:"280",height:"80",boxLineColor:"#5553ce",boxFillColor:"#f1f1f1",whiskerColor:"#32c861",outlierLineColor:"#c17d7d",medianColor:"#22e535",targetColor:"#316b1d"}),$("#sparkline10").sparkline([1,1,0,1,-1,-1,1,-1,0,0,1,1],{height:"80",width:"100%",type:"tristate",posBarColor:"#34d3eb",negBarColor:"#ec6794",zeroBarColor:"#0000ff",barWidth:8,barSpacing:3,zeroAxis:!1})},o=function(){var i,o=500,e=-1,r=-1,l=0,t=[],a=30
$("html").mousemove(function(i){var o=i.pageX,t=i.pageY
e>-1&&(l+=Math.max(Math.abs(o-e),Math.abs(t-r))),e=o,r=t})
var h=function(){var e=new Date,r=e.getTime()
if(i&&i!=r){var n=Math.round(l/(r-i)*1e3)
t.push(n),t.length>a&&t.splice(0,1),l=0,$("#sparkline5").sparkline(t,{tooltipSuffix:" pixels per second",type:"line",width:$("#sparkline1").width(),height:"165",chartRangeMax:77,maxSpotColor:!1,minSpotColor:!1,spotColor:!1,lineWidth:2,lineColor:"#32c861",fillColor:"rgba(50, 200, 97, 0.3)",highlightLineColor:"rgba(24,147,126,.1)",highlightSpotColor:"rgba(24,147,126,.2)"})}i=r,setTimeout(h,o)}
setTimeout(h,o)}
i(),o()
var e
$(window).resize(function(r){clearTimeout(e),e=setTimeout(function(){i(),o()},300)})})
