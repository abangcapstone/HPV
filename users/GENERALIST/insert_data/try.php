<?php
/**
 * Created by PhpStorm.
 * User: jenjen
 * Date: 17/08/2017
 * Time: 3:58 PM
 */
?>
<script type="text/javascript">
    function ulol1(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('cogs1[]');
        var i = document.getElementsByName('cogs1[]').length;
        var b = document.getElementsByName('cogs2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);
        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol2(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('adapta1[]');
        var i = document.getElementsByName('adapta1[]').length;
        var b = document.getElementsByName('adapta2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol3(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('competency1[]');
        var i = document.getElementsByName('competency1[]').length;
        var b = document.getElementsByName('competency2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol4(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('leadership1[]');
        var i = document.getElementsByName('leadership1[]').length;
        var b = document.getElementsByName('leadership2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol5(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('interpersonal1[]');
        var i = document.getElementsByName('interpersonal1[]').length;
        var b = document.getElementsByName('interpersonal2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol6(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('sens1[]');
        var i = document.getElementsByName('sens1[]').length;
        var b = document.getElementsByName('sens2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol7(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('physical1[]');
        var i = document.getElementsByName('physical1[]').length;
        var b = document.getElementsByName('physical2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol8(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('persistence1[]');
        var i = document.getElementsByName('persistence1[]').length;
        var b = document.getElementsByName('persistence2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol9(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('orient1[]');
        var i = document.getElementsByName('orient1[]').length;
        var b = document.getElementsByName('orient2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol10(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('integrity1[]');
        var i = document.getElementsByName('integrity1[]').length;
        var b = document.getElementsByName('integrity2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol11(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('motivate1[]');
        var i = document.getElementsByName('motivate1[]').length;
        var b = document.getElementsByName('motivate2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol12(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('quality1[]');
        var i = document.getElementsByName('quality1[]').length;
        var b = document.getElementsByName('quality2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol13(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('timeline1[]');
        var i = document.getElementsByName('timeline1[]').length;
        var b = document.getElementsByName('timeline2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol14(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('attendance1[]');
        var i = document.getElementsByName('attendance1[]').length;
        var b = document.getElementsByName('attendance2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol15(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('superior1[]');
        var i = document.getElementsByName('superior1[]').length;
        var b = document.getElementsByName('superior2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function ulol16(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('colleagues1[]');
        var i = document.getElementsByName('colleagues1[]').length;
        var b = document.getElementsByName('colleagues2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>





<!-- End of update -->




<script type="text/javascript">
    function lol1(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('eff1[]');
        var i = document.getElementsByName('eff1[]').length;
        var b = document.getElementsByName('eff2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol2(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('adapta_1[]');
        var i = document.getElementsByName('adapta_1[]').length;
        var b = document.getElementsByName('adapta_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol3(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('competency_1[]');
        var i = document.getElementsByName('competency_1[]').length;
        var b = document.getElementsByName('competency_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol4(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('leadership_1[]');
        var i = document.getElementsByName('leadership_1[]').length;
        var b = document.getElementsByName('leadership_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol5(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('interpersonal_1[]');
        var i = document.getElementsByName('interpersonal_1[]').length;
        var b = document.getElementsByName('interpersonal_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol6(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('sens_1[]');
        var i = document.getElementsByName('sens_1[]').length;
        var b = document.getElementsByName('sens_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol7(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('physical_1[]');
        var i = document.getElementsByName('physical_1[]').length;
        var b = document.getElementsByName('physical_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol8(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('persistence_1[]');
        var i = document.getElementsByName('persistence_1[]').length;
        var b = document.getElementsByName('persistence_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol9(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('orient_1[]');
        var i = document.getElementsByName('orient_1[]').length;
        var b = document.getElementsByName('orient_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol10(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('integrity_1[]');
        var i = document.getElementsByName('integrity_1[]').length;
        var b = document.getElementsByName('integrity_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol11(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('motivate_1[]');
        var i = document.getElementsByName('motivate_1[]').length;
        var b = document.getElementsByName('motivate_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol12(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('quality_1[]');
        var i = document.getElementsByName('quality_1[]').length;
        var b = document.getElementsByName('quality_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol13(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('timeline_1[]');
        var i = document.getElementsByName('timeline_1[]').length;
        var b = document.getElementsByName('timeline_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol14(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('attendance_1[]');
        var i = document.getElementsByName('attendance_1[]').length;
        var b = document.getElementsByName('attendance_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol15(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('superior_1[]');
        var i = document.getElementsByName('superior_1[]').length;
        var b = document.getElementsByName('superior_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>
<script type="text/javascript">
    function lol16(fieldObj) {
        var FileName = fieldObj.value;
        var o = document.getElementsByName('colleagues_1[]');
        var i = document.getElementsByName('colleagues_1[]').length;
        var b = document.getElementsByName('colleagues_2[]');
        var store = [];
        for (var x = 0; x < i; x++) {
            store[x] = o[x].value;

        }
        var indices = [];
        var ctr = store.indexOf(FileName);

        while (ctr != -1) {
            indices.push(ctr);
            ctr = store.indexOf(FileName, ctr + 1);
        }
        var len = indices.length;
        var arr=[];
        if (len > 1){
            for(x=0;x<len;x++){


                if (FileName == '') {
                    b[indices[x]].value = '';
                } else if (FileName <= 5 && FileName >= 0) {
                    b[indices[x]].value = 'Poor ';
                } else if (FileName > 5 && FileName < 7) {
                    b[indices[x]].value = 'Below Average ';
                } else if (FileName >= 7 && FileName < 8) {
                    b[indices[x]].value = 'Average ';
                } else if (FileName >= 8 && FileName <= 9) {
                    b[indices[x]].value = 'Above Average ';
                } else if (FileName > 9 && FileName <= 10) {
                    b[indices[x]].value = 'Superior ';
                } else {
                    b[indices[x]].value = '';
                }
            }
        }else{
            if (FileName == '') {
                b[indices].value = '';
            } else if (FileName <= 5 && FileName >= 0) {
                b[indices].value = 'Poor ';
            } else if (FileName > 5 && FileName < 7) {
                b[indices].value = 'Below Average ';
            } else if (FileName >= 7 && FileName < 8) {
                b[indices].value = 'Average ';
            } else if (FileName >= 8 && FileName <= 9) {
                b[indices].value = 'Above Average ';
            } else if (FileName > 9 && FileName <= 10) {
                b[indices].value = 'Superior ';
            } else {
                b[indices].value = '';
            }
        }
    }
</script>

