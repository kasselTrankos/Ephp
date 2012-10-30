################################################################################
# Automatically-generated file. Do not edit!
################################################################################

# Add inputs and outputs from these tool invocations to the build variables 
CPP_SRCS += \
../src/ats/com/Finder.cpp \
../src/ats/com/ParsePhp.cpp 

OBJS += \
./src/ats/com/Finder.o \
./src/ats/com/ParsePhp.o 

CPP_DEPS += \
./src/ats/com/Finder.d \
./src/ats/com/ParsePhp.d 


# Each subdirectory must supply rules for building sources it contributes
src/ats/com/%.o: ../src/ats/com/%.cpp
	@echo 'Building file: $<'
	@echo 'Invoking: GCC C++ Compiler'
	g++ -O0 -g3 -Wall -c -fmessage-length=0 -MMD -MP -MF"$(@:%.o=%.d)" -MT"$(@:%.o=%.d)" -o "$@" "$<"
	@echo 'Finished building: $<'
	@echo ' '


