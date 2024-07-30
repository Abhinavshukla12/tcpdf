<!DOCTYPE html>
<html>
<head>
    <title>Grid Data</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include jsPDF library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="my-4">JQ Grid Data</h1>
        <table class="table table-bordered" id="gridTable">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody id="gridBody">
                <?php foreach ($gridData as $row): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['value'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <button class="btn btn-primary" onclick="generatePDF()">Generate PDF</button>
        <div id="pdfLink" style="margin-top: 20px;"></div>
    </div>

    <script>
        async function generatePDF() {
            // Import jsPDF
            const { jsPDF } = window.jspdf;

            // Create a new instance of jsPDF
            const doc = new jsPDF();

            // Get the HTML of the table
            const table = document.getElementById("gridTable");

            // Initialize positions
            let startY = 10;
            let startX = 10;

            // Extract table rows and cells
            const rows = table.querySelectorAll('tr');
            rows.forEach((row, rowIndex) => {
                const cells = row.querySelectorAll('th, td');
                cells.forEach((cell, cellIndex) => {
                    // Add cell text to PDF
                    doc.text(cell.innerText, startX + (cellIndex * 40), startY + (rowIndex * 10));
                });
            });

            // Save the PDF to a Blob and create a download link
            const pdfBlob = doc.output('blob');
            const pdfUrl = URL.createObjectURL(pdfBlob);

            // Create a download link
            const linkElement = document.createElement('a');
            linkElement.href = pdfUrl;
            linkElement.download = 'grid_data.pdf';
            linkElement.textContent = 'Download PDF';

            // Update the div to show the link
            const pdfLinkDiv = document.getElementById('pdfLink');
            pdfLinkDiv.innerHTML = ''; // Clear any existing link
            pdfLinkDiv.appendChild(linkElement);
        }
    </script>
</body>
</html>
