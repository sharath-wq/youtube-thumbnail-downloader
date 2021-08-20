const urlField = document.querySelector(".field input")
const previewArea = document.querySelector(".preview-area")
const imgTag = previewArea.querySelector(".thumbnail")
const hiddenInput = document.querySelector(".hidden-input")

urlField.onkeyup = () => {
    let imgUrl = urlField.value
    previewArea.classList.add("active")

    if (imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1) {
        let vidId = imgUrl.split("v=")[1].substring(0, 11)
        let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`
        imgTag.src = ytThumbUrl
    } else if (imgUrl.indexOf("https://youtu.be/") != -1) {
        let vidId = imgUrl.split("be/")[1].substring(0, 11)
        let ytThumbUrl = `https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`
        imgTag.src = ytThumbUrl
    } else {
        imgTag.src = "" 
        previewArea.classList.remove("active")
    }
    hiddenInput.value = imgTag.src
}