/**
 * SVGObject
 *
 * cross-browser detect and embed script for SVG documents
 * based on flashObject (http://blog.deconcept.com/flashobject/)
 *
 * USAGE:
 *
 * Create a container <div> in the document to hold the SVG content, and 
 * immediately after this, put the script which replaces the content for an SVG
 * file, i.e.
 *
 * <div id="svgfile">
 * <p>This content will be replaced by the SVG file if it can be embedded in the page. Place alternative content here, such as a download link to Adobe's SVG Viewer</p>
 * </div>
 * <script type="text/javascript">
 * var svg = new svgObject(svgFile, svgID,  svgWidth, svgHeight, svgStyle);
 * svg.write("svgfile");
 * </script>
 *
 * SVGOBJECT CONSTRUCTOR ARGUMENTS:
 *
 * svgFile   - path to the SVG document which you want to embed
 * svgID     - ID of the resulting tags used to embed the SVG
 * svgWidth  - width in pixels of the SVG file
 * svgHeight - height in pixels of the SVG file
 * svgStyle  - CSS compliant string to insert into a style attribute in the embed/object/iframe tags
 *
 * SVGOBJECT PUBLIC METHODS
 * write(div_id) - replaces the content of the <div> with given ID with the code needed to embed the SVG file
 * getMethod() - returns either 'embed', 'object', or 'iframe' depending on which method has been used
 */
if (typeof org == "undefined") var org = new Object();
if (typeof org.e2 == "undefined") org.e2 = new Object();
org.e2.svgObject = function(svg, id, w, h, style) {
  if (!document.createElement || !document.getElementById) return;
  this.attributes = new Array();
	this.downloadLink = "http://www.adobe.com/svg/viewer/install/";

  if(svg) this.setAttribute('svg', svg);
  if(id) this.setAttribute('id', id);
  if(w) this.setAttribute('width', w);
  if(h) this.setAttribute('height', h);
  if(style) this.setAttribute('style', ' style="' + style + '"');
	
	this.embedHTML = this.getSVGHTML();
}
org.e2.svgObject.prototype = {
  setAttribute: function(name, value){
    this.attributes[name] = value;
  },
  getAttribute: function(name) {
	  if (this.attributes[name]) {
      return this.attributes[name];
		} else {
		  return '';
		}
  },
  getSVGHTML: function() {
	  /* first try to use an <embed> tag */
    if (navigator.plugins && navigator.mimeTypes && navigator.mimeTypes.length) { // netscape plugin architecture
	    this.method = 'embed';
      svgNode = this.getSVGembed();
		/* next try to use ActiveX + object tag */
    } else if (window.ActiveXObject) {
	    oSVG = false;
			for (x = 2; x < 10; x++) {
		    try {
			    oSVG = eval("new ActiveXObject('Adobe.SVGCtl."+x+"');");
			    if (oSVG) {
					  oSVG = true;
						continue;
			    }
		    } catch(e) {
				  oSVG = false;
				}
			}
			if (oSVG) {
  	    this.method = 'object';
				svgNode = this.getSVGobject();
			} else {
  	    this.method = 'iframe';
			  svgNode = this.getSVGiframe();
			}
    } else {
	    this.method = 'iframe';
  	  svgNode = this.getSVGiframe();
		}
    return svgNode;
  },
	getSVGembed: function() {
    svgNode = '<embed type="image/svg+xml" src="'+ this.getAttribute('svg') +'" width="'+ this.getAttribute('width') +'" height="'+ this.getAttribute('height') +'" pluginspage="' + this.downloadLink + '"';
    svgNode += this.getAttribute('style') + ' id="'+ this.getAttribute('id') +'" name="'+ this.getAttribute('id') +'" ';
    svgNode += '/>';
		return svgNode;
	},
	getSVGobject: function() {
    svgNode = '<object id="'+ this.getAttribute('id') +'" data="' + this.getAttribute('svg') + '" width="' + this.getAttribute('width') + '" height="' + this.getAttribute('height') + '" type="image/svg+xml" codebase="' + this.downloadLink + '"' + this.getAttribute('style') + '>';
    svgNode += "</object>";
		return svgNode;
	},
	getSVGiframe: function() {
		svgNode = '<iframe id="' + this.getAttribute('id') + '" src="' + this.getAttribute('svg') + '" width="' + this.getAttribute('width') + '" height="' + this.getAttribute('height') + '" frameborder="0" scrolling="0" marginheight="0" marginwidth="0"' + this.getAttribute('style') + '></iframe>';
		return svgNode;
	},
	getMethod: function() {
	  return this.method;
	},
  write: function(elementId){
    var n = (typeof elementId == 'string') ? document.getElementById(elementId) : elementId;
    n.innerHTML = this.embedHTML;
  }
}
var svgObject = org.e2.svgObject;
