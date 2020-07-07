$(document).ready(function() {
    $(".backButton").click(function() {
        window.history.back();
    });
    $("#countriesFilter").change(handleCountrySelect);
});

function handleCountrySelect(e) {
    // console.log(e);
    const countryId = e.target.options[e.target.selectedIndex].value;
    jQuery.getJSON(
        "/api/countries/" + countryId + "/counties",
        {},
        populateCountiesDropdown
    );
}

function populateCountiesDropdown(data) {
    console.log(data);
    $("#countiesFilter")
        .find("option")
        .remove();
    data.forEach(function(item) {
        $("#countiesFilter").append(new Option(item.name, item.id));
    });
}
