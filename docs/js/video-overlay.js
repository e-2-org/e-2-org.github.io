/*
 * Video overlays: a link with data-video plays its video in an overlay over
 * the page, instead of going to the video file (which is where the link goes
 * without JavaScript). The close button, Escape, or a click outside the video
 * closes it.
 *
 *   <a href="piece.mp4" data-video data-poster="piece.png" data-width="1920" data-height="1080">watch</a>
 */
(function () {
    let dialog, video;

    function create() {
        dialog = document.createElement('dialog');
        dialog.className = 'video-overlay';
        dialog.innerHTML = '<button type="button" class="video-overlay-close" aria-label="Close">&times;</button><video controls playsinline></video>';
        video = dialog.querySelector('video');
        dialog.querySelector('button').addEventListener('click', () => dialog.close());
        /* a click on the dialog itself, not the video or the button, is a click on the backdrop */
        dialog.addEventListener('click', e => { if (e.target === dialog) dialog.close(); });
        dialog.addEventListener('close', () => {
            video.pause();
            video.removeAttribute('src');
            video.load();
        });
        document.body.append(dialog);
    }

    document.addEventListener('click', e => {
        const link = e.target.closest('a[data-video]');
        if (!link || e.ctrlKey || e.metaKey || e.shiftKey) return;
        e.preventDefault();
        if (!dialog) create();
        video.width = link.dataset.width || 1920;
        video.height = link.dataset.height || 1080;
        video.style.aspectRatio = `${video.width} / ${video.height}`;
        video.poster = link.dataset.poster || '';
        video.setAttribute('aria-label', link.dataset.label || link.textContent);
        video.src = link.href;
        dialog.showModal();
        video.play().catch(() => {});
    });
})();
