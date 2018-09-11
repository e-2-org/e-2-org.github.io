/**
 * e2.js
 * common functions used on the e-2 site
 */

function launchProject(id){
    var basepath="http://www.e-2.org/";
		var win = null;
    //launches all projects based on keywords passed as arguments
    switch (id) {
		case "perhect":
        opts = getOpts("scrollbars,resizable,", (screen.availWidth - 30), (screen.availHeight - 50), 15, 15);
				win = window.open(basepath + "perhect/frame.html", "perhect", opts);
				break;
    case "error404":
        opts = getOpts("", 1024, 100, ((screen.availWidth/2)-512), ((screen.availHeight/2)-50));
        win = window.open(basepath+'c-ship/projects/error404/index.html', 'scroller', opts);
        self.close();
				break;
    case 'nowhere':
        opts = getOpts("scrollbars,resizeable,", 800, 600, ((screen.availWidth/2)-400), ((screen.availHeight/2)-300));
        win = window.open(basepath+'c-ship/projects/nowhere/apbl.html', 'nowhere', opts);
				break;
    case 'tome':
        opts = getOpts("", screen.availWidth, screen.availHeight, 0, 0);
        win = window.open(basepath+'c-ship/projects/tome/tome.html', 'tome', opts);
				break;
    case 'ahouse':
        opts = getOpts("", screen.availWidth, screen.availHeight, 0, 0);
        win = window.open(basepath+'c-ship/projects/ahouse/fr.html', 'ahouse', opts);
				break;
    case 'pigstails':
        opts = getOpts("", screen.availWidth, screen.availHeight, 0, 0);
        win = window.open(basepath+'c-ship/projects/pigstails/apgo.html', 'pigstails', opts);
				break;
    case 'birdisland':
        opts = getOpts("toolbars,location,menubar,scrollbars,status,resizeable", screen.availWidth, screen.availHeight, 0, 0);
        win = window.open('http://www.bird-island.com/', 'birdisland', opts);
				break;
		case 'minus20':
        opts = getOpts("toolbars,location,menubar,scrollbars,status,resizeable", screen.availWidth, screen.availHeight, 0, 0);
        win = window.open(basepath+'minus20/index.html', 'minus20', opts);
				break;
		case 'sevenacts':
        opts = getOpts("toolbars,location,menubar,scrollbars,status,resizeable", screen.availWidth, screen.availHeight, 0, 0);
        win = window.open('http://www.7actsoflove.org/', 'sevenacts', opts);
				break;
		case 'cruisin':
        alert("Sorry, this project is no longer available online");
				break;
		case 'adelaide':
        opts = getOpts("", screen.availWidth, screen.availHeight, 0, 0);
        win = window.open(basepath+'c-ship/projects/adelaide/preadelaide.html', 'adelaide', opts);
				break;
    }
		if (win != null) {
		    if (win.focus) {
				    win.focus();
				}
		}
}
function getOpts(stub, w, h, sx, sy)
{
    opts = stub;
		if (window.innerWidth && window.screenX) {
		    opts += 'innerWidth=' + w + ',innerHeight=' + h + ',screenX=' + sx + ',screenY=' + sy;
		} else {
		    opts += 'width=' + w + ',height=' + h + ',left=' + sx + ',top=' + sy;
		}
		return opts;
}
function launchQTVR()
{
    var win = window.open('http://www.e-2.org/commissions/perhect-launch-360.html', 'perhect-launch', 'width=1000,height=700');
		if (win != null) {
		    if (win.focus) {
				    win.focus();
				}
		}
}
/**END PROJECT LAUNCHER**/
