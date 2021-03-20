var picturelist = new Vue({
  el: "#picturelist",
  data: {
    pictures: [],
    index: 0,
    interval: null,
    visible: false
  },
  methods: {
    run: function () {
      this.visible = true;
    },
  },
  computed: {
    currentPicture: function () {
      return this.pictures[this.index % this.pictures.length] || { link: "", title: "" };
    }
  }
});

function nextPic() {
	document.getElementById("startText").style.visibility = "hidden";
	var last = Math.floor(Math.random() * 30);
	picturelist.index = last;
	var audio = new Audio('sound.ogg');
	audio.play();
	picturelist.run();
}

onload = getData();

function getData() {
	reddit.new("cursedimages").limit(30).fetch(function (res) {
		res.data.children.forEach(function (child) {
			if (child.data.url && child.data.url.endsWith(".jpg")) {
				picturelist.pictures.push({ link: child.data.url, title: child.data.title || "" })
				picturelist.pictureCount += 1;
			}
		})
	});
}