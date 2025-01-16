document.addEventListener("DOMContentLoaded", async function () {
    const elements = document.querySelectorAll("[id^='currency-'], [id^='crypto-']");

    elements.forEach(async (element) => {
        const id = element.id;
        const [type, from, to] = id.split("-");

        try {
            const response = await fetch(`fetch_data.php?type=${type}&from=${from}&to=${to}`);
            const data = await response.json();

            if (type === "currency") {
                element.textContent = `1 ${from} = ${data.result.toFixed(2)} ${to}`;
            } else if (type === "crypto") {
                element.textContent = `1 ${from.toUpperCase()} = ${data.result.toFixed(2)} ${to.toUpperCase()}`;
            }
        } catch (error) {
            console.error("Error fetching data:", error);
            element.textContent = "Data unavailable";
        }
    });
});
