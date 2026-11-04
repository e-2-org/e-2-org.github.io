# Bringing the e-2 archive back: a summary of all the work

From October to November 2026, Pete worked with Claude Code to bring e-2's commissions and projects back to life. They date from 1997 to 2010, and most had stopped working years ago. Each now has its own repository in the [e-2-org](https://github.com/e-2-org) organisation on GitHub, and is published at `e-2-org.github.io/<name>/`. The e-2 site links to them all.

This document is an overview of what was done to each piece, how and why. Each repository's `_sessions/summary.md` has the details, and `_sessions/transcript.md` has the full conversations.

## Why the work had stopped

Most of the pieces were made for technologies that no longer exist:

- **Browser plugins.** Flash, Shockwave (Director), Cosmo Player (VRML 3D worlds), Adobe's SVG Viewer and QuickTime (including QuickTime VR panoramas) were all plugins. Browsers no longer run plugins at all, and Adobe ended Flash at the end of 2020.
- **Server software.** Several pieces needed PHP and MySQL, or ASP, on e-2's own server: to save visitors' texts, to run a chat, or to store GPS positions as they arrived.
- **Old browser behaviour.** Much of the work was built from framesets, popup windows sized and placed by script, and pages written for Netscape 4 and Internet Explorer 4. Modern browsers block or handle these differently.
- **Dead services.** These include the Google Maps API v2, the Blogger and Flickr embeds, Google Analytics' old tags and hit counters.

## How it was approached

The same principles were applied throughout:

- **The originals are kept unchanged.** Each repository holds the artist's original files at the top level, as they were archived. The working version is in `docs/`, which is what GitHub Pages publishes from the `main` branch. Nothing the artist made was redrawn: the ports use the original drawings, scans, sounds and fonts.
- **The piece is read rather than retyped.** Wherever possible, scripts extracted what was in the original files:
  - timelines, text, shapes and fonts from Flash and Director files;
  - positions, image maps and links from HTML pages;
  - locations from database exports.

  The new versions are built from that. This kept the timings, wording and positions exact, and makes the work repeatable.
- **Emulate or port.** For each piece, the choice was between running the original in an emulator and rebuilding it in modern HTML, CSS, SVG and JavaScript:
  - **Emulated:** Tome runs its original VRML files in X_ITE, a JavaScript VRML player. The Future from Memory was rendered to video from the original Flash files with Ruffle, a Flash emulator.
  - **Ported:** most of the others were rebuilt, because a port behaves as the piece did, scales to any screen and doesn't depend on an emulator's gaps.
- **Checked against the original.** Ports were compared with the original running in an emulator or with frames rendered from the original files. The comparisons were frame by frame, click by click and pixel by pixel, at desktop and phone sizes, in headless Chrome.
- **Video as a record.** Several time-based pieces were also rendered to video, frame-exact, for showing, projecting and keeping.
- **Privacy and security before publishing.** Before any repository was made public, its files and history were checked for passwords, email addresses and personal details. Where they were found, they were removed, or the repository was rebuilt without its old history (see minus20, Location of I, Notion Nanny, Bird Island and Who Knew Whom).

## The e-2 site

**[e-2-org.github.io](https://e-2-org.github.io/)**: the organisation's own site.

- Moved from flat HTML to a Jekyll site, with one file per project and commission, converted by script from the original pages, so no text was retyped.
- Every page was compared pixel by pixel with the original at three widths.
- The e-2 logo was redrawn as SVG.
- The Word Perhect installation's QuickTime VR panorama at Chisenhale Gallery was rebuilt from its 50 tiles into a panorama you can look around in the browser.
- Every commission and project now links to its new site.
- Each piece that has video opens it in an overlay.
- Two new pages tell how The Future from Memory and The Story of Art were made and re-made.
- container-ship and Notion Nanny were added, and Pete reorganised the pages and styles in November.

## Commissions

### container-ship (1998)

**[c-ship](https://e-2-org.github.io/c-ship/)**: e-2's project for the Network Museum Project, Japan, with new work by artists who weren't digital artists. Several of the commissions below started as part of it.

- **The ship deck:** it was a table of 29 image slices. It's now a scene that scales with the window, where the rooms and containers light up on hover, keyboard focus or touch, with no script needed.
- **Pages:** the room, artist and work pages were regenerated from the originals.
- **Lettering:** a 1990s typeface that couldn't be identified was rebuilt as a font from the images of its letters. The missing letters were drawn on the same grid, so the titles and names are now text rather than pictures.

### minus20

**[minus20](https://e-2-org.github.io/minus20/)**: nine web-based artworks selected from an open submission.

- **The ports:** all seven Flash and Shockwave pieces were ported to HTML.
  - The Director files were unprotected and decompiled, and their scores read with a purpose-written script.
  - *_down* paints its falling stripes pixel by pixel, as Director's ink effects did.
  - *H-BOMB WORDS* types its 7,960 characters, one every third of a second.
  - *slider* works at any screen width.
- **Who Knew Whom's slider:** Nat Goodden asked for it to start at the size of the screen showing it, so there's now also an SVG version alongside the bitmap port.
- **Privacy:** the old repository's history held entrants' submission emails, so a new repository was built from scratch with only what the site uses, checked for personal data and then published.

### Word Perhect, Tomoko Takahashi (2000)

**[wordperhect](https://e-2-org.github.io/wordperhect/)**: a hand-drawn word processor. It was part of the artist's Turner Prize nomination, the first digital work recognised by the prize.

- **What survived:** only the compiled Flash movies, with no source files.
- **What was extracted:** a script pulled out the timelines, shapes, three handwriting fonts and nine scanned papers.
- **The port:** about 500 ActionScript handlers were ported by hand, onto a small runtime that plays Flash 4 timelines as SVG.
- **Saving:** texts are kept in the visitor's own browser in place of the old PHP and MySQL back-end.
- **Checking:** the port was driven side by side with the original in Ruffle, and every difference was fixed: text layout, hover, masks, missing characters and printing.
- **Quirks kept:** backspace scribbles over a letter rather than deleting it, as in the original.

### Adelaide, Simon Faithfull

**[adelaide](https://e-2-org.github.io/adelaide/)**: line drawings that dissolve into one another, one per click.

- **Before:** a loading frameset and a preloader.
- **Now:** one page, which builds the 93-step sequence of 51 drawings from a table of its nine scenes. The sequence was checked step for step against the original.

### error 404, Anna Best

**[error404](https://e-2-org.github.io/error404/)**: a 20-minute piece in which about 170 popup windows open, move and close around the screen while a story is typed.

- **Before:** Pete had started converting it by hand in 2023, covering 70 seconds.
- **Extraction:** a script now runs the original scripts against a virtual clock and screen, as Netscape 4 did, and records every window over the whole 1,212 seconds.
- **Playback:** a player replays that record on a 1024×768 desktop scaled to fit the browser. The desktop is drawn as Windows 98 or Mac OS 8, chosen from the viewer's computer, as the original chose its stylesheet.
- **Video:** it can be rendered to video in either style.

### Now Here / Nowhere, Brighid Lowe

**[nowhere](https://e-2-org.github.io/nowhere/)**: words fading and scrolling across the screen.

- **The port:** the two Flash files were decoded, and every placement of every text on every frame became CSS animation, using the original Times New Roman outlines.
- **Checking:** frames were compared with the original to within anti-aliasing.
- **Video:** a 1080p video keeps Flash's own frame rate and its jumpiness.

### Tome, David Lilley

**[tome](https://e-2-org.github.io/tome/)**: a VRML world of the rooms the artist once lived in, built for the Cosmo Player plugin.

- **The approach:** the original 3D files now play in X_ITE, a JavaScript VRML player, almost unchanged.
- **The fix:** clicks on the navigation spheres registered but didn't move the view, because X_ITE follows the VRML standard more strictly than Cosmo did. One line was added to each of nine navigation scripts so they move the view themselves.

### Pig's Tails, Gill Ord

**[pigstails](https://e-2-org.github.io/pigstails/)**: a video still slowly unpicked into patches and laid down again.

- **How it worked:** nobody remembered what the control buttons did. Decoding the files showed they zoomed and panned the Flash movie through the browser plugin's scripting, which Ruffle doesn't support.
- **The port:** SVG, with every patch shown at exactly its original frames. The rollovers work as Flash's buttons did, and the controls work again.

### A house is not a home, Geraint Evans

**[ahouse](https://e-2-org.github.io/ahouse/)**: a journey through a suburban house.

- **The port:** 21 pages with image maps became one page of SVG scenes, with every hotspot carried over exactly.
- **Checking:** all 53 links were clicked through.
- **Colours:** where a scene is made of several GIFs, each slice had been saved with its own palette, so colours jumped at the joins. Those were matched without changing the drawings.

### Bird Island, Janice Kerbel

**[bird-island](https://e-2-org.github.io/bird-island/)**: a brochure site for villas on an imaginary island.

- **Changes:** it still worked, so it was repaired rather than rebuilt:
  - the beach map's swapped links;
  - a stylesheet browsers ignored;
  - broken table attributes;
  - popup links that went nowhere without JavaScript;
  - accessibility.
- **Checking:** every page was compared pixel by pixel before and after, and is unchanged.
- **Privacy:** the registration form no longer sends what visitors type.

### 7 acts of love, Oreet Ashery

**[7actsoflove](https://e-2-org.github.io/7actsoflove/)**: work with the artist's alter ego, Marcus Fisher.

- **The god-therapist session:** it was three PHP pages, a database and 57 Flash sound clips. It now runs entirely in the browser, with the original branching, artwork and voice. Nothing is stored.
- **Rest of the site:** the hand-positioned archive pages, galleries and popups became a Jekyll site, with windows over the page.
- **Videos:** the eight Flash videos are now MP4.

## Projects

### The Future from Memory, Emma Kay (Chisenhale Gallery, 2003)

**[futurefrommemory](https://e-2-org.github.io/futurefrommemory/)**: an animated text projection of the history of the world still to come.

- **The original:** five Flash movies on a CD, which loaded one another in turn.
- **The video:** rendered from the original files with Ruffle's frame exporter at 1440×1080. The segments were joined where the originals handed over, into one 43-minute piece of 64,753 frames.
- **Widescreen:** a 16:9 version removes the top quarter, which was checked on every frame and is always blank.
- **4K:** UHD and DCI versions were rendered in November 2026, in case Emma wants them for a large projection.
- **No site:** it was always a projection, so the video is now the piece. The repository's `redux/` folder holds a page made for Emma and a colleague to look through the videos; the e-2 site now shows the video itself.

### The Story of Art, Emma Kay (Tate Modern)

**[storyofart](https://e-2-org.github.io/storyofart/)**: Emma's history of art written from memory: 108,812 words over 9½ hours, projected 25 feet wide and looped for 11 months.

- **Why it stopped:** it was SVG and SMIL animation for Adobe's SVG Viewer, which modern browsers can't run.
- **The browser version:** a new player reads the Tate version's own files and runs the whole piece. It draws every letter from the original embedded font, so the text grows smoothly.
- **Video:** the piece was rendered frame by frame to HD video, and in November 2026 to UHD and DCI 4K. There are also 72 section videos.

### eyes-down, Anna Best (1998–2000)

**[eyesdown](https://e-2-org.github.io/eyesdown/)**: the archive of Anna's residency at the State Mecca Bingo Hall, Kilburn, presented as a bingo card.

- **Before:** popup windows, framesets and sound played by hidden Flash files.
- **Now:** the card is centred on the page, and each number calls, is marked and opens its topic in a window coloured to match its cell. A full house wins.
- **Sound:** sounds were taken from the Flash files, or re-encoded from better-quality originals where they existed.
- **Shaun Fox's recordings:** eleven recordings of Shaun Fox's talk, which were in the files but never used, are now on his page.
- **Recovered pages:** two empty pages of the talk were recovered from an earlier transcription.

### Contact, Amy Plant (2000)

**[contact](https://e-2-org.github.io/contact/)**: conversations with local people around Camden Arts Centre's North London Link.

- **Before:** a 6000-pixel field of 393 boxes, scrolled by moving the mouse to the edge of the screen.
- **Now:** it works with a mouse and on touch screens.
- **Pages:** the 198 popup pages became windows over the field.
- **Videos:** the QuickTime clips are now MP4.
- **External links:** the 31 links to other websites go to the Internet Archive's copies from around November 2000.

### Notion Nanny, Allison Smith (2005–2010)

**[notionnanny](https://e-2-org.github.io/notionnanny/)**: the touring project's website, with its Blogger blog and Flickr photos.

- **Source:** rebuilt from a 2010 archive copy, with the 162 blog posts and 7 press items as their own pages.
- **Privacy:** before publishing, Blogger's admin links and a spam comment were removed, and the commenters' names taken out.

### Location of I, Martin John Callanan (2007–2009)

**[locationofi](https://e-2-org.github.io/locationofi/)**: the artist's GPS location, published online as it happened.

- **Before:** the live site depended on a polling server, MySQL and Google Maps v2.
- **Now:** a static archive of all 38,822 locations, with three views:
  - a replay of the whole project as the live page showed it;
  - a calendar archive of the 601 days;
  - a looping gallery version.
- **Security:** the old server was found to be serving a file containing database passwords, which Pete was told about. The repository was recreated without credentials in its history.

### Who Knew Whom, Nat Goodden

**[wkw](https://e-2-org.github.io/wkw/)**: research into who knew whom among more than 3,400 figures in the arts and sciences.

- **Data:** it was exported from WordPress and cleaned:
  - duplicates merged;
  - date typos corrected, such as Wordsworth's death a century out;
  - the corrections kept as data.
- **Wikidata and RDF:** people were matched to Wikidata, and everything was published as RDF.
- **The site:** a Jekyll site with the same pages and design as WordPress, plus:
  - a "field" view of each person's circle;
  - a network of everyone at once;
  - a SPARQL query page that runs in the browser.
- **Following Nat's wishes:** links stay as plain acquaintance, with no relationship types, and occupations aren't borrowed from Wikidata.

## Where things stand

- **Live sites:** every repository listed above is public and published from `docs/` on `main`. The exception is The Future from Memory, whose preview page is published from `redux/` by an Actions workflow; as the piece is a video, it was left as it is.
- **Not linked yet:** Location of I is published, but the e-2 site doesn't link to it yet.
- **Not tested:** across the work, the ports were tested in Chrome; real phones, Safari and Firefox were mostly not.
- **Per-piece gaps:** each repository's summary lists its known gaps and decisions still to make.
- **Local only:** the 4K videos are on Pete's machine and not yet uploaded anywhere.

## What the artists said

Emma Kay, on seeing The Future from Memory and The Story of Art again:

> I am actually overwhelmed by what you have done. That may sound daft and sorry to be soppy but it has brought a tear to my eye: I haven't seen either of these works since they were being exhibited. The babies I was toting around during their making are all grown up. Its brought it all back, the enormous amount of work you guys did, the endless last minute changes I subjected you to, your patience, my stress/your stress, my thrill when the works were first projected. Pretty sure I didn't thank you enough at the time.

Anna Best, on error 404:

> Pete that's made my day month !!! Year even!
