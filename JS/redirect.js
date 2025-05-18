if (document.getElementById("finalTotals")) {
    const message = document.createElement("p");
    message.textContent = "Preusmerjanje na index.php v 10 sekundah...";
    document.getElementById("finalTotals").appendChild(message);

    setTimeout(() => {
        window.location.href = "index.php";
    }, 10000);
}