<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../global.css" />
</head>

<body>

    <my-navbar logo="../../assets/insta-logo.png" specific-path="../../"></my-navbar>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:mx-0.5 lg:mx-0.5">
            <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <p class='text-4xl font-bold py-4'>Users List</p>

                    <table class="min-w-full">
                        <thead class="bg-white border-b">
                            <tr>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Username
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Name
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Email
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Birthdate
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Gender
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Password
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Created At
                                </th>
                                <th scope="col" class="text-sm font-bold text-gray-900 px-6 py-4 text-left">
                                    Delete Account
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "../../config/koneksi.php";

                            $sql = "SELECT * FROM users";
                            $result = mysqli_query($conn, $sql);
                            $counter = 1;

                            while ($row = mysqli_fetch_array($result)) {
                                echo $counter % 2 == 1 ? "<tr class='bg-gray-100 border-b'>" : "<tr class='bg-white border-b'>";
                                echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900'>" . $row['username'] . "</td>";
                                echo "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" . $row['name'] . "</td>";
                                echo "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" . $row['email'] . "</td>";
                                echo "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" . $row['birthdate'] . "</td>";
                                echo "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" . $row['gender'] . "</td>";
                                echo "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" . $row['password'] . "</td>";
                                echo "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>" . $row['created_at'] . "</td>";
                                echo "<td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'><a class='px-6 py-3 bg-red-500 hover:bg-red-700 rounded-md text-white font-bold' href='delete.php?id=" . $row['username'] . "'>Delete</a></td>";
                                echo "</tr>";

                                $counter++;
                            }

                            mysqli_close($conn);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href='convert.php' onclick="alert('Convert success!')" class='ml-8 block mt-4 w-[150px] border border-black bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded hover:cursor-pointer'>
        Convert to XML
    </a>

    <script src="../../components/SideBar.js"></script>
    <script src="../../components/Navbar.js"></script>
</body>

</html>