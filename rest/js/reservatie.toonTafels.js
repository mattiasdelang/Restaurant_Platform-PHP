/**
 * Created with JetBrains PhpStorm.
 * User: Dieter
 * Date: 3/05/14
 * Time: 23:03
 * To change this template use File | Settings | File Templates.
 */
$(document).ready(function(){

    var _openingsUren = [];

    for (dagdeel in openingsUren) {
        var start = openingsUren[dagdeel][0];
        var stop = openingsUren[dagdeel][1];

        var van = new Date(dag.getFullYear(), dag.getMonth(), dag.getDate(), start[0], start[1]);
        var tot = new Date(dag.getFullYear(), dag.getMonth(), dag.getDate(), stop[0], stop[1]);

        _openingsUren.push([van,tot]);
    }

    openingsUren = _openingsUren;

    var regex = /(\d+):(\d+):(\d+)/;
    var now = new Date();



    $('.time').timepicker({ timeFormat: 'H:i:s',
        'useSelect': true,
        createRow: function(timeString) {
            var match  = timeString.match(regex);
            var uur    = parseInt(match[0]);
            var minuut = parseInt(match[1]);

            var datum = new Date(dag.getFullYear(), dag.getMonth(), dag.getDate());
            datum.setHours(uur);
            datum.setMinutes(minuut);

            var open = false;

            $.each(openingsUren,function(tijdstip){
                var van = openingsUren[tijdstip][0];
                var tot = openingsUren[tijdstip][1];

                if (!open && datum > now && datum >= van && datum < tot) {
                    open = true;
                    return false; // break;
                }
            });

            if (!open) {
                return false;
            }

            var row = $('<option />', { 'value': timeString });
            row.text(timeString);
            return row;
        }
    });
});