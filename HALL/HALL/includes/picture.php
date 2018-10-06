<style>
@keyframes slider {

0% {
	left: 0;
}

20% {
	left: 0;
}

25% {
	left: -100%;
}

45% {
    left: -100%;

}

50% {
		left: -200%;

}

70% {
	left: -200%;
}

75% {
	left: -300%;
}

95% {
	left: -300%;
}

100% {
	left: -400%;

}

}

#slider {
	overflow: hidden;
}

#slider figure img {
	width: 20%;
	height:400px;
	float: left;
}

#slider figure {
	position: relative;
	width: 500%;
	margin: 0;
	left: 0;
	text-align: left;
	font-size: 0;
	animation: 20s slider infinite; 

}
</style>

<div id="slider" >
<figure>
<img src="images/1511190125320_1400x600_p2websiteheader_v1.png"/>
<img src="images/resident-evil-vendetta.png"/>
<img src="images/black-ops-ii-wallpaper-1400x600.jpg"/>
<img src="images/inception-poster-10.jpg"/>
<img src="images/maxresdefault-6-1.jpg"/>


</figure>	

</div>