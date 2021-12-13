let videos = document.querySelectorAll(".text-block video, .text-block iframe")

let ks = []

for (let i = 0; i < videos.length; i++) {
    let video = videos[i]

    ks[i] = (parseInt(video.style.height) || video.height) / (parseInt(video.style.width) || video.width)
}

let resize = () => {
    for (let i = 0; i < videos.length; i++) {
        let video = videos[i]

        video.style.height = (video.clientWidth * ks[i]) + "px"
    }
}

resize()

window.addEventListener('resize', resize)