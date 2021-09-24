var len = 3;
var es = document.getElementsByClassName( 'js-teaser' );
var str = '';
var trunc = '';

if( es.length > 0 ) {
	for( var i = 0; i < es.length; i++ ) {
		str = '';
		trunc = '';
		var ps = es[i].getElementsByTagName( 'p' );

		if( ps.length > 0 ) {
			for( var x = 0; x < ps.length; x++) {
				str += ps[x].innerHTML + ' ';
			}
		}

		trunc = str.split( '.' ).splice( 0, len ).join( '.' );
		es[i].innerHTML = '<p>' + trunc + '.</p>';
	}
}