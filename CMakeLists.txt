
cmake_minimum_required(VERSION 3.17)
project(testfileupload C)

set(CMAKE_C_STANDARD 11)

add_executable(testfileupload main.c)


find_package(PkgConfig REQUIRED)

#######################################################################################################################
############################################ SDL2 config ##############################################################
#######################################################################################################################

pkg_check_modules(SDL2 REQUIRED sdl2)
pkg_check_modules(SDL2_IMG REQUIRED SDL2_image)
include_directories(${SDL2_INCLUDE_DIRS} ${SDL2_IMG_INCLUDE_DIRS})
link_directories (${SDL2_LIBRARY_DIRS} ${SDL2_IMG_LIBRARY_DIRS})
target_link_libraries (testfileupload ${SDL2_LIBRARIES} ${SDL2_IMG_LIBRARIES}) #Oublie pas de changer le premier argument
FIND_PACKAGE_HANDLE_STANDARD_ARGS(SDL2 REQUIRED_VARS SDL2_LIBRARY SDL2_INCLUDE_DIR)


#######################################################################################################################
############################################ GTK config ##############################################################
#######################################################################################################################

pkg_check_modules(GTK3 REQUIRED gtk+-3.0)
include_directories(${GTK3_INCLUDE_DIRS})
link_directories(${GTK3_LIBRARY_DIRS})
add_definitions(${GTK3_CFLAGS_OTHER})
message(${GTK3_LIBRARIES})
target_link_libraries(testfileupload ${GTK3_LIBRARIES})

# lib xls
target_link_libraries(testfileupload -lxlsxwriter)
#lib curl
target_link_libraries(testfileupload -lcurl)
