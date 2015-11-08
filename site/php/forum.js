$('.form-control').change(function () {
    var selectedText = $(this).find("option:selected").text();

 if (selectedText == "Water leak") {
        $('.water-leak').show();
        $('.general-water').hide();
        $('.drain-issue').hide();
        $('.other').hide();
        $('.water-issue-other').hide();
    }

    if (selectedText == "General Water Supply Issue") {
        $('.general-water').show();
        $('.water-leak').hide();
        $('.drain-issue').hide();
        $('.other').hide();
        $('.water-issue-other').hide();
    }
    if (selectedText == "Drain Issue") {
        $('.drain-issue').show();
        $('.water-leak').hide();
        $('.general-water').hide();
        $('.other').hide();
        $('.water-issue-other').hide();
    }

    if (selectedText == "Other") {
        $('.other').show();
        $('.drain-issue').hide();
        $('.water-leak').hide();
        $('.general-water').hide();
        $('.water-issue-other').hide();
    }


        if (selectedText == "Other water issue") {
            $('.water-issue-other').show();
        }

        if (selectedText == "Discolour") {
            $('.water-issue-other').hide();
        }

        if (selectedText == "Smell") {
            $('.water-issue-other').hide();
        }

        if (selectedText == "Taste") {
            $('.water-issue-other').hide();
        }

        if (selectedText == "Low pressure") {
            $('.water-issue-other').hide();
        }

        if (selectedText == "High pressure") {
            $('.water-issue-other').hide();
        }

        if (selectedText == "No supply") {
            $('.water-issue-other').hide();
        }

            if (selectedText == "Other drain issue") {
                $('.drain-issue-other').show();
            }

            if (selectedText == "Flooding my house") {
                $('.drain-issue-other').hide();
            }

            if (selectedText == "Flooding my garden") {
                $('.drain-issue-other').hide();
            }

            if (selectedText == "Flooding public area") {
                $('.drain-issue-other').hide();

            }

            if (selectedText == "Seeping manhole") {
                $('.drain-issue-other').hide();
            }

            if (selectedText == "Blockage") {
                $('.drain-issue-other').hide();
            }

            if (selectedText == "smell") {
                $('.drain-issue-other').hide();
            }
});